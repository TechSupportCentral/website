#!/bin/sh
# If you are running a TSCBot then this is already in your DB!
sqlite3 website.db "
CREATE TABLE staff_applications(
    uid TEXT,
    time INTEGER,
    type TEXT,
    status TEXT,
    q1 TEXT,
    q2 TEXT,
    q3 TEXT,
    q4 TEXT,
    q5 TEXT,
    q6 TEXT,
    q7 TEXT,
    q8 TEXT,
    q9 TEXT,
    q10 TEXT
);
CREATE TABLE ban_appeals(
    uid TEXT,
    email TEXT,
    time INTEGER,
    status TEXT,
    reason TEXT,
    appeal TEXT
);
"