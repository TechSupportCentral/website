# What is this branch?
The ISP of the server that runs this website blocks port 80, so this website is inaccessible from http. However, port 443 is not blocked, so https works fine.
This branch is a solution for if someone attempts to connect with http. It contains a simple redirect from GitHub Pages to the actual website over https.

### Why not just host this website with GitHub Pages directly?
That's how it was originally hosted. However, when staff applications and a ban appeal feature were added, it required server-side code in the form of PHP.
GitHub Pages only supports static content (HTML, CSS, and JS), so the website had to be hosted elsewhere.

### Why not host the website on a VPS?
We don't want a Discord Server to take up a significant point of our lives to the point where we would be spending money on it.
Our bots are also self-hosted, so it made sense to self-host the website too, despite the ISP complications.
