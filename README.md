## README SETUP 

# Heading
## Main Section
### Sub Section
#### Small heading

- Bullet Points
1. Numbered list

Code Blocks
` inline `

```bash
multi line
``` 
Link
[Swagger UI](http://localhost/swagger)

Bold & Italic 
**Important**  
*Optional*

Blockquote  
> This project requires PHP 8.1

Checkboxes
- [x] API setup
- [ ] Docker support

Tables
| Command | Description |
|-------|------------|
| git pull | Get latest code |
| git push | Upload changes |


# LearnAPI
📌 Overview

LearnAPI is a PHP-based API application built on PHP 8.1, using Composer for dependency management and Twilio IVR integration.
This document explains how to set up the project locally and on server environments (development, staging, production).

## Table of Contents
- [Requirements](#requirements)
- [Installation](#installation)
- [Environment Setup](#environment-setup)
- [How to Run](#how-to-run)
- [API Documentation](#api-documentation)
- [Git Workflow](#git-workflow)

## ✅ Requirements
Make sure the following are installed on your system:
- PHP 8.1
- Composer
- XAMPP
- MySQL
- Web server (XAMPP – Apache running)
- Browser (Chrome / Firefox)
- ngrok (for HTTPS)
- Twilio Account (for IVR)
- Git
 
## Installation
1. Clone repository
2. Install dependencies
3. Setup environment files


## Environment Setup
- .env.development
- .env.staging
- .env.production

## How to Run
1. Start XAMPP
2. Start Apache & MySQL
3. Run composer update
4. Access project via browser

## Database Setup
- Database name: learnapi

## Third-Party Services
- Twilio IVR
- ngrok HTTPS

## API Documentation
Swagger is used for API documentation.

## Git Workflow
- git pull before work
- feature branches
- git revert instead of reset


## Folder Structure
app/
public/
swagger/
vendor/

## Troubleshooting
- Vendor missing → composer update
- DB error → check .env


## Contributing
Please create feature branches and raise PR.

## License
MIT License



## 📂 Project Setup

1️⃣ Clone the Repository

```bash
git clone <repository-url>
cd learnapi
```

2️⃣ Install Dependencies
Run Composer to install vendor files:

```bash
composer update
```
This will generate the vendor/ directory.

## 🗄️ Database Setup
1. Create a database named:

```bash
CREATE DATABASE learnapi;
```
2 Update database credentials in your .env file (see Environment Setup below).

## ⚙️ Environment Configuration
- The project uses multiple environment files.
- Create environment files in the project root.

### Environment Files
Create the following files in the project root:
- .env.development
- .env.staging
- .env.production

### Development Environment
.env.development

```bash
APP_ENV=development
APP_DEBUG=true

DB_HOST=127.0.0.1
DB_DATABASE=learnapi
DB_USERNAME=root
DB_PASSWORD=

TWILIO_SID=your_twilio_sid
TWILIO_AUTH_TOKEN=your_twilio_auth_token
TWILIO_PHONE=your_twilio_number
```

### Production Environment
.env.production

```bash
APP_ENV=production
APP_DEBUG=false
```

### Staging Environment
.env.staging

```bash
APP_ENV=staging
APP_DEBUG=false
```
## 🌐 Virtual Host Setup

```bash 
<VirtualHost *:80>
    ServerName learnapi.local
    DocumentRoot /var/www/learnapi/public

    <Directory /var/www/learnapi>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>

```

## Add this to your hosts file:

```bash
127.0.0.1   learnapi.local
```

Restart Apache after changes.

## 🔐 HTTPS with ngrok (Required for Twilio)
Twilio requires a public HTTPS URL.
Start ngrok:

```bash
ngrok http 8000
```

You will get an HTTPS URL like:

```bash
https://abcd-1234.ngrok-free.app
```
Use this URL in:
- Twilio webhook configuration
- APP_URL in .env

## ☎️ Twilio IVR Setup
- 1. Login to Twilio Console
- 2. Navigate to Phone Numbers → Active Numbers
- 3. Buy or use a Twilio phone number
- 4. Set Voice Webhook URL to:
  
```bash
https://abcd1234.ngrok.io/webhook
```

- 5. HTTP Method: POST
- 6. Make sure webhook route exists in the project

## ▶️ How to Run the Project

```bash
php artisan serve
```

Access the app at:

```bash
http://localhost:8000
```

## 📁 Folder Permissions

## 🧪 Testing
Run tests (if applicable):

```bash
composer test
```

## 🛠️ Troubleshooting

Vendor missing → run composer update
Twilio webhook not working → check ngrok HTTPS URL
500 error → check storage/cache permissions
DB error → verify .env credentials

## 📞 Support

For issues or improvements, please contact the development team or raise a ticket in the repository.

## 🧰 Local Server Requirement (XAMPP)

Before running the project, make sure XAMPP is running.
### Steps:
#### Open XAMPP Control Panel
#### Start the following services:
    - ✅ Apache
    - ✅ MySQL
#### Confirm:
    - Apache → http://localhost
    - MySQL → running without errors

#### ❗ The project will not run if Apache or MySQL is stopped.


## 🔧 Git Setup & Configuration
1️⃣ Install Git
Verify installation:
```bash
git --version
```

2️⃣ Configure Git (First Time Only)

```bash
git config --global user.name "Your Name"
git config --global user.email "your@email.com"
```

Check config:
```bash
git config --list
```

## 📥 Git Clone Repository
```bash
git clone <repository-url>
cd learnapi
```

## 🔄 Git Pull (Get Latest Code)
Always pull before starting work:
```bash
git pull origin main
```

## 📤 Git Push (Upload Your Changes)

Step-by-step:

```bash
git status
git add .
git commit -m "Your commit message"
git push origin your-branch-name
```

## 🌿 Git Branch Commands

Create new branch:
```bash
git checkout -b feature/your-feature-name
```

Switch branch:
```bash
git checkout branch-name
```

List branches:
```bash
git branch
```

## 📜 Git Log (View History)

Show commit history:

```bash
git log
```

Short version:
```bash
git log --oneline
```

Last 5 commits:
```bash
git log -5
```

## ⏪ Git Revert & Reset (IMPORTANT)

🔙 Revert a Commit (Safe – Recommended)
```bash
git revert commit_id
```

Creates a new commit that undoes changes.

⚠️ Reset (Use Carefully)

Reset last commit (keep changes):
```bash
git reset --soft HEAD~1
```

Reset and delete changes:
```bash
git reset --hard HEAD~1
```

## 🔧 Swagger Setup


### Check or Verify Versions
Make sure PHP 8.1 is installed:


```bash
php -v
```

```bash
composer -v
```

```bash
nvm -v
```

```bash
npm -v
```

```bash
node -v
```

```bash
mysql -v
```


## Composer Setup
Install vendor dependencies:

```bash
composer install
```
If vendor files already exist and need update:

```bash
composer update
```
