# Transactions-Checker
First iteration of the Transactions Checker tool, which is basically an attempt at aggregating data from the indexer db in a useful format, to display properties on wallets, transactions, and groups of wallets, in a systematic format. We feel it could be useful for analyzing the number of transactions, amounts, connected wallets, and such, that particular users have performed on the network. A lowkey analyzer in other words. Given the datasource, the analyzed material is limited to wallets that have conducted at least one transfer of naan. In strict terminology, we analyze transfers of naan and not generally 'transactions' in the strict sense, though colloquially, we feel it's justified to use transactions wholesale.
# Prerequisites
1. A working namadexer installation which serves a Postgre SQL database
2. PHP 8.1+, installed with either Apache or nginx, or another suitable webserver, with Postgre SQL module
3. Unfortunately, in an unforeseen "recent developments", the Namadexer team has decided to wholesale delete the table we employ for this project. We are guessing you would have to install an older branch of Namadexer for this to work, specifically one which retains the tx_transfers-table in the db, before it was deleted. We may look into upgrading our query structure, but needless to say, this whole thing is demotivating for developing when things can change that rapidly with little consideration for those that use the application.
# Installation
1. Place all php files in the package in the same directory, which is the directory served by your php-enabled webserver
2. Make sure php actually parses files before proceeding to the next step, as otherwise it could be a big security risk
3. Edit the db_settings567.php-file, and input the appropriate values for your local setup.
4. The pages should run out of the box if everything above is satisfied
# Further
People are welcome to contribute to this repo, or fork to their own and use in any further development.
