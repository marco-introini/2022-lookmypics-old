# Photo Acceptance Tool

This program is aimed to photographers who need to share their images to client for acceptance.

# Usage

- Photographer need to login in the admin area and 
  - create a gallery, with username and password for access
  - upload images
  - send the gallery link to the client
- the client, using a very simple interface, can browse the images and, for each of them, can flag it as Accepted or Rejected

# Installation

- clone the repository
- create a .env file: `cp .env.example .env`
- create the mysql database
- run migration: `php artisan migrate --seed`
- login to /admin with email admin@mintdev.me and password 'password'

# Bulk Upload

You can add multiple images in a single album. This features uses jobs to automatically insert them into album.

To use this feature:

- using a ftp client put your jpegs on upload directory under storage/app
- inside the Album administration use the Multi Upload button

# License

This software is free to use under the MIT License