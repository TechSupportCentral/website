<!DOCTYPE html>
<html lang="en">
    <?php
        $title = "Staff Application | Tech Support Central";
        $stylesheet = 'application.css';
        include 'includes/head.php';
    ?>
    <body>
        <?php include 'includes/header.html'; ?>
        <div id="content">
            <form>
                <p>What role are you applying for?</p>
                <input type="radio" id="mod" name="type" value="mod">
                <label for="mod">Moderator</label><br>
                <input type="radio" id="spteam" name="type" value="spteam">
                <label for="spteam">Support Team</label>
                <div class="modQuestion hide">
                    <p>If a member is doing something against our rules (i.e. spamming, sending NSFW), what should you do?</p>
                    <input type="radio" id="mod1op1" name="mod1" value=1>
                    <label for="mod1op1">Leave it and see what happens</label><br>
                    <input type="radio" id="mod1op2" name="mod1" value=2>
                    <label for="mod1op2">Mute the member</label><br>
                    <input type="radio" id="mod1op3" name="mod1" value=3>
                    <label for="mod1op3">Ban the member</label><br>
                    <input type="radio" id="mod1op4" name="mod1" value=4>
                    <label for="mod1op4">Issue a warning</label><br>
                </div>
                <div class="modQuestion hide">
                    <p>If you or another member sees someone advertising, what should you do?</p>
                    <input type="radio" id="mod2op1" name="mod2" value=1>
                    <label for="mod2op1">Do nothing</label><br>
                    <input type="radio" id="mod2op2" name="mod2" value=2>
                    <label for="mod2op2">Mute the member</label><br>
                    <input type="radio" id="mod2op3" name="mod2" value=3>
                    <label for="mod2op3">Ban the member</label><br>
                    <input type="radio" id="mod2op4" name="mod2" value=4>
                    <label for="mod2op4">Issue a warning</label><br>
                </div>
                <div class="modQuestion hide">
                    <p>If a member asks for help or advice with cracked/illegal content, what should you do?</p>
                    <input type="radio" id="mod3op1" name="mod3" value=1>
                    <label for="mod3op1">Do nothing</label><br>
                    <input type="radio" id="mod3op2" name="mod3" value=2>
                    <label for="mod3op2">Ban the member</label><br>
                    <input type="radio" id="mod3op3" name="mod3" value=3>
                    <label for="mod3op3">Warn the member; in the warn message, let them know about our rules.</label><br>
                    <input type="radio" id="mod3op4" name="mod3" value=4>
                    <label for="mod3op4">Inform the member publicly of our rules and that we cannot offer any help.</label><br>
                </div>
                <div class="modQuestion hide">
                    <p>We ask you to enable Discord's Developer Mode so you can easily retrieve a user's ID.</p>
                    <input type="radio" id="mod4op1" name="mod4" value=1>
                    <label for="mod4op1"> I understand; I will enable developer mode. </label><br>
                    <input type="radio" id="mod4op2" name="mod4" value=2>
                    <label for="mod4op2"> I understand; I am unsure how to, so a staff member must show me how to enable this. </label><br>
                </div>
                <div class="modQuestion hide">
                    <p>If your application gets accepted, you will temporarily have a "Trial Moderator" role with less permissions.</p>
                    <input type="checkbox" id="mod5" name="mod5">
                    <label for="mod5">I understand.</label>
                </div>
                <div class="modQuestion hide">
                    <p>Applying for this role means that you have the opportunity to become a Moderator; if you wish to be a Support Team member as well then you can apply via the Support Team application form.</p>
                    <input type="checkbox" id="mod6" name="mod6">
                    <label for="mod6">I understand.</label>
                </div>
                <div class="modQuestion hide">
                    <p>As a moderator, you will have to adhere and follow the rules.</p>
                    <input type="checkbox" id="mod7" name="mod7">
                    <label for="mod7">I understand.</label>
                </div>
                <div class="spteamQuestion hide">
                    <p>Are you currently or have you previously provided Tech Support in any other discord servers or a real life career?</p>
                    <input type="radio" id="sp1op1" name="sp1" value=1>
                    <label for="sp1op1"> Yes, I currently do. </label><br>
                    <input type="radio" id="sp1op2" name="sp1" value=2>
                    <label for="sp1op2"> I have in the past. </label><br>
                    <input type="radio" id="sp1op3" name="sp1" value=3>
                    <label for="sp1op3"> No, not before. </label><br>
                </div>
                <div class="spteamQuestion hide">
                    <p>Are you able to be active on the server at least 2-3 times a week?</p>
                    <input type="radio" id="sp2op1" name="sp2" value=1>
                    <label for="sp2op1"> Yes </label><br>
                    <input type="radio" id="sp2op2" name="sp2" value=2>
                    <label for="sp2op2"> No </label><br>
                </div>
                <div class="spteamQuestion hide">
                    <p>What do you specialize in?</p>
                    <input type="checkbox" name="sp3op1">
                    <label for="sp3op1"> Software </label><br>
                    <input type="checkbox" name="sp3op2">
                    <label for="sp3op2"> Hardware </label><br>
                    <input type="checkbox" name="sp3op3">
                    <label for="sp3op3"> PC Builds </label><br>
                    <input type="checkbox" name="sp3op4">
                    <label for="sp3op4"> Mobile </label><br>
                    <input type="checkbox" name="sp3op5">
                    <label for="sp3op5"> Networking </label><br>
                    <input type="checkbox" name="sp3op6">
                    <label for="sp3op6"> Linux </label><br>
                </div>
                <div class="spteamQuestion hide">
                    <p>Are you confident in giving advice and offering support?</p>
                    <input type="radio" id="sp4op1" name="sp4" value="true">
                    <label for="sp4op1"> Yes </label><br>
                    <input type="radio" id="sp4op2" name="sp4" value="false">
                    <label for="sp4op2"> No </label><br>
                </div>
                <div class="spteamQuestion hide">
                    <p>Are you okay with notifying other Support Team members if you are unsure how to deal with a case that you are involved in?</p>
                    <input type="radio" id="sp5op1" name="sp5" value="true">
                    <label for="sp5op1"> Yes </label><br>
                    <input type="radio" id="sp5op2" name="sp5" value="false">
                    <label for="sp5op2"> No </label><br>
                </div>
                <br>
                <input type="submit" class="hide" value="Submit Application">
                <script>
                    function addRequired(element) {
                        element.querySelectorAll(':scope > *').forEach(child => {
                            // Support Team question 3 can have multiple answers, not required
                            if (child.tagName === "INPUT" && !child.getAttribute("name").startsWith("sp3")) {
                                child.required = true;
                            }
                        });
                    }
                    function removeRequired(element) {
                        element.querySelectorAll(':scope > *').forEach(child => {
                            if (child.tagName === "INPUT") {
                                child.required = false;
                            }
                        });
                    }
                    function hideModQuestions() {
                        document.querySelectorAll('.modQuestion').forEach(element => {
                            element.classList.add('hide');
                            removeRequired(element);
                        });
                        document.querySelectorAll('.spteamQuestion').forEach(element => {
                            element.classList.remove('hide');
                            addRequired(element);
                        });
                        document.querySelector('input[type=submit]').classList.remove('hide');
                    }
                    function hideSupportTeamQuestions() {
                        document.querySelectorAll('.modQuestion').forEach(element => {
                            element.classList.remove('hide');
                            addRequired(element);
                        });
                        document.querySelectorAll('.spteamQuestion').forEach(element => {
                            element.classList.add('hide');
                            removeRequired(element);
                        });
                        document.querySelector('input[type=submit]').classList.remove('hide');
                    }
                    document.getElementById('mod').onclick = hideSupportTeamQuestions;
                    document.getElementById('spteam').onclick = hideModQuestions;
                </script>
            </form>
        </div>
        <?php include 'includes/footer.html'; ?>
    </body>
</html>