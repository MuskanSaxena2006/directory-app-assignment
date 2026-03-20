# Directory Management Application

This is a database management application built in Laravel, designed to handle bulk data imports, identify and merge duplicate records, and generate comprehensive data reports. 

This project was developed as a technical assignment for the backend developer position.

## 🚀 Features

* **Bulk Data Import:** Upload `.csv` or `.xlsx` files to populate the database.
* **Duplicate Identification & Merging:** Automatically detects duplicate records based on `Business Name` + `Area` + `City`. The merge function preserves the oldest record, fills in any missing data (like mobile numbers) from the duplicates, and then removes the redundant entries.
* **Reporting Dashboard:** Provides real-time metrics including total listings, unique/duplicate counts, incomplete listings, and specific grouping counts (City-wise, Category+City, Category+Area).

## 🛠️ Prerequisites

Before you begin, ensure you have the following installed:
* PHP >= 8.1
* Composer
* MySQL or any compatible database

## 📦 Installation & Setup

1. **Extract the project folder** and navigate to it in your terminal.
2. **Install dependencies:**
   ```bash
   composer install