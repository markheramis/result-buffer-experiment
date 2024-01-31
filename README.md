# PHP PDO Result Buffer Experiment

This project serves as an experimental and demonstrative exploration of the differences between buffered and unbuffered results when fetching data from a MySQL database using PHP's PDO (PHP Data Objects).

## Table of Contents

- [PHP PDO Result Buffer Experiment](#php-pdo-result-buffer-experiment)
  - [Table of Contents](#table-of-contents)
  - [Features](#features)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Usage](#usage)
  - [Functions](#functions)
    - [fetchUnbufferedResult](#fetchunbufferedresult)
      - [Pros](#pros)
      - [Cons](#cons)
    - [fetchBufferedResult](#fetchbufferedresult)
      - [Pros](#pros-1)
      - [Cons](#cons-1)
    - [Time Tracking](#time-tracking)
  - [Todo](#todo)

## Features

- Fetches unbuffered and buffered results from a MySQL database.
- Provides examples of pros and cons for both unbuffered and buffered results.
- Includes time tracking before and after function calls.

## Prerequisites

- PHP installed on your machine
- Access to a MySQL database
- Composer installed (for additional dependencies)

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/markheramis/result-buffer-experiment.git
   ```
2. Navigate to the project directory:
   ```
   cd result-buffer-experiment
   ```

## Usage

1. Update the database connection parameters in the script (script.php) with your own values:
   ```
   $dsn = 'mysql:host=localhost;dbname=your_database';
   $username = 'your_username';
   $password = 'your_password';
   $table = 'your_table';
   ```
2. Run the script:

   ```
   php index.php
   ```

## Functions

### fetchUnbufferedResult
Fetches and displays unbuffered result from the database.

#### Pros
- Lower memory usage: Suitable for large result sets as data is not fully fetched into memory at once.
- Faster initial results: The first rows are available sooner as the database doesn't have to wait for the entire result set.
#### Cons
- Limited backward traversal: Rows can only be traversed forward, not backward.
- Fetching is slower for small result sets: Overhead of fetching rows one by one might outweigh the benefit.

### fetchBufferedResult
Fetches and displays buffered result from the database.

#### Pros
- Easy backward traversal: Can freely move backward and forward in the result set.
- Faster fetching for small result sets: Fetching all rows at once may be faster for smaller datasets.

#### Cons
- Higher memory usage: May not be suitable for large result sets as the entire result set is loaded into memory.
- Slightly longer initial wait time: The first rows are available after the entire result set is fetched.


### Time Tracking

The script includes time tracking before and after each function call to measure the execution time of `fetchUnbufferedResult` and `fetchBufferedResult`. The total execution time is displayed after each set of operations.

## Todo
- add example .sql files