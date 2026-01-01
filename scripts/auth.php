<?php
require $_SERVER['DOCUMENT_ROOT'] . '/scripts/discord.php';
require $_SERVER['DOCUMENT_ROOT'] . '/includes/config.php';

// Authenticate user
$page = basename($_SERVER['PHP_SELF']);
init($site_root . $page, $client_id, $secret_id);
// Get user email if it's an appeal
if ($page == "appeal.php") {get_user(true);} else {get_user();}

/** Check if user's account creation and server join dates meet requirements
 * @param $min_age int Minimum required account age, in seconds
 * @param $min_join int Minimum required time since user joined server, in seconds
 * @return int 0 if requirements met, 1 if age requirement not met, or 2 if join requirement not met
 */
function age_check(int $min_age, int $min_join): int {
    if (strtotime(get_joined_at()) > (time() - $min_join)) {
        return 2;
    }

    // Get just the first 42 bits from user ID (ms since Discord epoch)
    $acct_created = $_SESSION['user_id'] >> 22;
    // Divide by 1000 (ms to s) and add 45 years of seconds (Discord epoch to Unix epoch)
    $acct_created = $acct_created / 1000 + 1420070400;
    if ($acct_created > (time() - $min_age)) {
        return 1;
    }

    return 0;
}

/** Check if user has already submitted an application or appeal which is still pending
 * @return bool true if user has a pending submission, false otherwise
 */
function submission_check(): bool {
    global $db_file;
    global $page;

    try {
        $db = new SQLite3($db_file);
        $db->enableExceptions(true);
    } catch (SQLite3Exception $e) {
        // Assume no application has been submitted
        return false;
    }

    $table = match ($page) {
        'appeal.php' => 'ban_appeals',
        default => 'staff_applications'
    };
    $query = "SELECT status FROM $table WHERE uid = :id;";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $_SESSION['user_id']);
    try {
        $result = $stmt->execute();
        $pending = false;
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            // Return true if there are any pending applications/appeals
            if ($row['status'] == 'pending') {
                $pending = true;
            }
        }
        $result->finalize();
        $stmt->close();
        $db->close();
        return $pending;
    } catch (SQLite3Exception $e) {
        // Assume no application has been submitted
        return false;
    }
}