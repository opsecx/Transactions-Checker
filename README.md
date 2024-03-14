# Transactions-Checker
First iteration of the Transactions Checker tool, which is basically an attempt at aggregating data from the indexer db in a useful format, to display properties on wallets, transactions, and groups of wallets, in a systematic format. We feel it could be useful for analyzing the number of transactions, amounts, connected wallets, and such, that particular users have performed on the network. A lowkey analyzer in other words. Given the datasource, the analyzed material is limited to wallets that have conducted at least one transfer of naan. In strict terminology, we analyze transfers of naan and not generally 'transactions' in the strict sense, though colloquially, we feel it's justified to use transactions wholesale. Now also added monikers and such for SE. (this requires a manual load of data once)
# Prerequisites
1. A working namadexer installation which serves a Postgre SQL database
2. PHP 8.1+, installed with either Apache or nginx, or another suitable webserver, with Postgre SQL module
3. Unfortunately, in recent devlopments, the Namadexer team has decided to wholesale delete the table we employ for this project. We are looking to see if this can be remedied somehow, but so far the only solution is to install an older version of Namadexer which has the tx_transfers table, specifically commit ec415ab1cd110c13a7c080e7a2789c6a77ddd62b is the one we use and have developed up against (git clone -b <commit-hash>). Obviously it's on our to-do list to change the queries, but this was a very sudden change that was out of our hands (and that we are in communication with the Namadexer team about).
# Installation
1. Place all php files in the package in the same directory, which is the directory served by your php-enabled webserver
2. Make sure php actually parses files before proceeding to the next step, as otherwise it could be a big security risk
3. Edit the db_settings567.php-file, and input the appropriate values for your local setup.
4. The pages should run out of the box if everything above is satisfied
5. For player data, make sure you run the pages at least once to create our schema and table, then data can be loaded from csv using the psql console.
# Further
People are welcome to contribute to this repo, or fork to their own and use in any further development.
