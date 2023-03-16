


PRE-REQUIREMENTS:
1. Installed VQMod
2. PHPExcel library(Already included in distro).


HOW THE STUFF WORKS:
You can find example in file exp.zip

* Download archive to a folder 'download'
* Unpack archive
* Search for file product.xlsx if exist start parsing.
* CHECK if products category exist. If not, skip current product.
* CHECK if product model already exist to prevent duplicating.
* If all checks OK, insert product into DB. 
* DELETE ALL CONTENT from 'download' folder

ABOUT 'product.xlsx'
At the moment script doesn't perform any data validation, maybe later i will add some.
so:
- don't create any additional sheets
- don't rearrange column order inside the range A:H
- don't create any hidden columns inside the range A:H

Original column order is:
A - categoty
B - Model
C - Name
D - Description
E - Quantity
F - Price
G - Image file name
H - Additional images file list separated by ';'

BEFORE YOU START:
* it's strongly recommended to create a DATABASE BACKUP every time before you use this tool
* check that all categories for products already exist
* after successful import, check system error log for more information about import process


HOW TO INSTALL:
1. Copy content of 'upload' folder to your site root
2. Go to System > Users > User groups
   and add permissions for 'tool/xls_import'
3. Now you can use tool under menu System > EXCEL Import 