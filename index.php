<?php
# Database connection parameters
$dsn = 'mysql:host=localhost;dbname=your_database';
$username = 'your_username';
$password = 'your_password';
$table = 'your_table';

/**
 * Fetches and displays unbuffered result from the database.
 *
 * Pros of unbuffered result:
 * - Lower memory usage: Suitable for large result sets as data is not fully fetched into memory at once.
 * - Faster initial results: The first rows are available sooner as the database doesn't have to wait for the entire result set.
 *
 * Cons of unbuffered result:
 * - Limited backward traversal: Rows can only be traversed forward, not backward.
 * - Fetching is slower for small result sets: Overhead of fetching rows one by one might outweigh the benefit.
 *
 * @param string $dsn Database connection string
 * @param string $username Database username
 * @param string $password Database password
 * @param string $table Database table
 */
function fetchUnbufferedResult($dsn, $username, $password, $table) {
	try {
		# Create a PDO instance with unbuffered query option set to false
		$pdo = new PDO($dsn, $username, $password, array(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => false));

		# Execute a query with unbuffered result
		$stmtUnbuffered = $pdo->query("SELECT * FROM $table");
		while ($row = $stmtUnbuffered->fetch(PDO::FETCH_ASSOC)) {
			print_r($row); # print human readable format
		}
	} catch (PDOException $e) {
		# Handle connection errors
		echo 'Connection failed: ' . $e->getMessage();
	}
}

/**
 * Fetches and displays buffered result from the database.
 *
 * Pros of buffered result:
 * - Easy backward traversal: Can freely move backward and forward in the result set.
 * - Faster fetching for small result sets: Fetching all rows at once may be faster for smaller datasets.
 *
 * Cons of buffered result:
 * - Higher memory usage: May not be suitable for large result sets as the entire result set is loaded into memory.
 * - Slightly longer initial wait time: The first rows are available after the entire result set is fetched.
 *
 * @param string $dsn Database connection string
 * @param string $username Database username
 * @param string $password Database password
 * @param string $table Database table
 */
function fetchBufferedResult($dsn, $username, $password, $table) {
	try {
		# Create a PDO instance with buffered query (default behavior)
		$pdoBuffered = new PDO($dsn, $username, $password);
		# Execute a query with buffered result
		$stmtBuffered = $pdoBuffered->query("SELECT * FROM $table");
		while ($row = $stmtBuffered->fetch(PDO::FETCH_ASSOC)) {
			print_r($row); # print human readable format
		}
	} catch (PDOException $e) {
		# Handle connection errors
		echo 'Connection failed: ' . $e->getMessage();
	}
}

# Time tracking before fetching unbuffered result
$startFetchUnbufferedResult = microtime(true);

# Call the function to fetch unbuffered result
fetchUnbufferedResult($dsn, $username, $password, $table);

# Time tracking after fetching unbuffered result
$endFetchUnbufferedResult = microtime(true);
$executionTimeUnbuffered = $endFetchUnbufferedResult - $startFetchUnbufferedResult;

# Display total execution time for fetchUnbufferedResult
echo "Total execution time for fetchUnbufferedResult: {$executionTimeUnbuffered} seconds\n";

# Time tracking before fetching buffered result
$startFetchBufferedResult = microtime(true);

# Call the function to fetch buffered result
fetchBufferedResult($dsn, $username, $password, $table);

# Time tracking after fetching buffered result
$endFetchBufferedResult = microtime(true);
$executionTimeBuffered = $endFetchBufferedResult - $startFetchBufferedResult;

# Display total execution time for fetchBufferedResult
echo "Total execution time for fetchBufferedResult: {$executionTimeBuffered} seconds\n";
?>
