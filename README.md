# Directory App - Data Management Assignment

A Laravel-based web application designed to handle bulk business directory data. This project processes CSV/Excel uploads, generates real-time analytical reports, and intelligently manages duplicate records. 

Built as an assignment for the Laravel Developer position at Honeybee Digital.

## 🚀 Core Features

* **Feature A: Bulk Data Import:** Upload `.csv` or `.xlsx` files to populate the database. The system automatically skips entirely blank rows to maintain data integrity.
* **Feature B: Duplicate Management:** An intelligent merging system that identifies duplicate listings based on an exact match of **Name + Area + City**. When merged, it keeps the oldest record, fills in missing data (like mobile numbers) from the newer duplicates, and securely deletes the redundant rows.
* **Feature C: Reporting Dashboard:** A real-time analytics dashboard displaying:
  * Total Listings
  * City-wise & Category-wise breakdowns
  * Unique vs. Duplicate listing counts
  * Incomplete listings (missing mobile, category, or sub-category)

## 🛠 Prerequisites

Before setting up the project, ensure your local environment has:
* PHP 8.1+
* Composer
* MySQL or MariaDB
* Laravel 10.x / 11.x requirements

## ⚙️ Installation & Setup

Follow these steps to get the application running on your local machine:

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/MuskanSaxena2006/directory-app-assignment.git](https://github.com/MuskanSaxena2006/directory-app-assignment.git)
   cd directory-app-assignment
Install PHP dependencies:

Bash
composer install
Set up your environment file:
Duplicate the .env.example file and rename it to .env.

Bash
cp .env.example .env
Configure the Database:
Create a new MySQL database (e.g., directory_app). Open your .env file and update the database credentials to match your local setup:

Code snippet
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=directory_app
DB_USERNAME=root
DB_PASSWORD=
Generate the application key:

Bash
php artisan key:generate
Run Database Migrations:
This will create the necessary businesses table with the custom schema.

Bash
php artisan migrate
Start the local development server:

Bash
php artisan serve
The application will be accessible at http://127.0.0.1:8000.

🧪 How to Test the Application
Format your CSV: The import function is explicitly mapped to the provided assignment data. Ensure your CSV/Excel file contains the following headers (case-insensitive due to Laravel Excel):

Name

Area

City

phone1

Category

SubCategory

Import Data: Navigate to the root URL / and use the "Bulk Data Import" panel to upload your file.

View Analytics: Once imported, the top metrics cards and tables will instantly populate with the database statistics.

Merge Duplicates: Scroll down to the "Duplicate Data Management" section. It will display a list of all duplicated groups. Click "Merge All Duplicates" to watch the system consolidate the data and update the dashboard counts in real-time.
