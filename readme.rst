#############################
Volunteer Website
#############################

This is the term project for COMP 4711 at BCIT for the Winter 2015 semester.

**************
Proposal
**************

Volunteer Website is a social site meant to bring together those who want to volunteer and organizations that want volunteers to aid their cause.

Users will be able to create an account, log in, customize their profile and browse other users or organizations for compatability. 

I am not planning to build any sort of messaging system or grouping system for users (an unofficial organization) in this prototype, however they would ideally be in the final version.

**************
Features
**************

This project is intended to be a prototype for a web app I plan to build in the near future. Basic features will be implemented, including:
- user and organization account creation
- profile customization
- search functionality
- canned causes or alignments for organizations and users
- algorithm to determine how compatible users and organizations are

**************
Current State
**************

Currently, I have hard-coded user and organization data into the User and Organization models. However, the links in the nav bar only display one each.

You can cycle through the stored data by manually typing the ids 1-4 for users and 5-8 for organizations into the URL, like so: .../user/{id}

Search is non-functional, and there is no way to register for an account.