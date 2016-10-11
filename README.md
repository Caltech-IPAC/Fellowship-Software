# Fellowship-Software

Introduction

This is a PHP/MySQL web database application designed to collect applications for a
fellowship program, including letters of recommendation. Confirmation emails are sent
upon successful application and letter submission. Application materials are collected
in a password-protected area where letters can be attached to the appropriate application
and a final PDF file of the entire application, including letters, can be created.

Requirements:
- Apache or other web server
- PHP version 5.0 or newer
- MySQL version 4.1 or newer
- pdftk command-line tool (https://www.pdflabs.com/tools/pdftk-the-pdf-toolkit/)
- jquery-validation library (included in this distribution)
- phpmailer library (included in this distribution)
- FPDF Free PDF generator (included in this distribution)

Setting up the database:

1. Create a database called “fellows” (or whatever else you want to call it)

mysql>create database fellows;

2. Create a username and password for that database
mysql>grant select, insert, update on fellows.* to 'username’@‘hostname’ 
identified by 'password';

3. Read in the mysqldump file
/path/to/mysql -u root -p fellows < fellows_dump.sql

4. Update “config.php” with the host name, database name, username, and password


=================================================================================

Description of database:

There are three tables: “fellows”, “letters”, and “users”

* fellows table

This table contains information that the applicants enter into the application submission
form, e.g. their contact information, PhD information, proposed host institutions and
research, and the names of their references. The table also contains several columns 
related to the application review process. These columns aren’t needed if you are only
using the system to collect the applications.

This table will be populated automatically as applications are submitted.

* letters table

This table contains information about the recommendation letters that the letter-writers
enter into the letter submission form, e.g. the applicant’s name and email address and the 
letter-writer’s name and email address.  

This table will be populated automatically as letters are submitted.

* users table

This table contains usernames and passwords for people who need to log in to the system
to view the submitted materials.  

To populate this table, use the following SQL syntax:
mysql>insert into users values (NULL, ‘FirstName LastName’, ‘username’, ‘password’, ‘admin’);

Passwords should be hashed. Instructions on how to do this are in ‘passwords.php’;


=================================================================================

Setting up the configuration file:

The file "config.php" contains information about connecting to the database (described 
above) and other variables that are used throughout the application.

Create two directories to hold the submitted applications and letters of recommendation.  
Update config.php with the paths to these directories:

$basedir = "/path/to/applications/directory/";
$basedir2 = "/path/to/letters/directory/";

We typically do not place these in a web-accessible directory so that the files
are not available via URL. These directories must be writable by your webserver.


=================================================================================

Application and Letter Submission Forms:

* Application Submission Form (application.php)

This is where the applicants will enter their application information and upload 
documents related to their applications. Form validation is handled by the
"jquery-validation" plugin.

The script that processes the form is "submit_app.php". The form information 
is entered into the database and a unique directory for the applicant is 
automatically created containing their uploaded files. A PDF coversheet is 
generated (using the FPDF library, included in this distribution) and appended 
to their uploaded files. The resulting PDF file (coversheet + uploaded files) 
is attached to the confirmation email that is sent to the applicant (using the 
"phpmailer" library, included in this distribution).

***
The command-line tool "pdftk" is required to concatenate the PDF files. This 
tool can be obtained here:
https://www.pdflabs.com/tools/pdftk-the-pdf-toolkit/
***

Upon successful form submission, the application page redirects to "thankyou.php".

* Letter Submission Form (letter.php)

This is where letters of recommendation are submitted. The letter-writers enter
their name and email address, the applicant's name and email address, and then 
upload their letter. Form validation is handled by the "jquery-validation" plugin.

The script that processes the form is "submit_letter.php". The form information 
is entered into the database, the letter is copied to the letters directory, and 
a confirmation email is sent to both the applicant and the letter-writer.

Upon successful letter submission, the page redirects to "thankyou2.php".


=================================================================================

Managing Applications and Letters

The application and letter management area is password-protected and can be accessed 
through the "login.php" page. Usernames and passwords are stored in the "users" table 
as described above.  The script "password_check.php" validates passwords and directs 
users to the "welcome.php" page upon successful login. The Welcome page lists two 
options: "View applications" and "View letters".

* View Applications (list_apps.php)

This page lists the submitted applications. Basic information about each applicant
is listed, along with links to the submitted application materials (CV, research
statements, etc.). After the reference letters are moved to the applicant's individual
directory (details in next section), the "Letters" column will contain links to the
reference letters. A PDF document containing the coversheet and all of the application 
materials (minus the letters) is available in this table (this is the same file that
was attached to the confirmation email to the applicant). Links to "create" and "view" 
the final PDF application (including the letters) are in the last column.

To create the final application, after the required number of letters are submitted
and moved to the applicant's directory (see next section), click the "create" link.  
This will concatenate all of the application materials, including the coversheet, 
documents uploaded by the applicant, and all of their letters of recommendation into 
one final PDF file. If the PDF is successfully created, the "view" link will become 
active.

Occasionally some of the files to be concatenated are not real PDFs, which will 
cause the concatenation to fail. In this case, the "view" link will not become 
active or will not open properly. Check that all files to be concatenated are truly 
PDFs, convert any if necessary, and re-click the "create" link.

* View Letters (list_letters.php)

This page lists the submitted letters of recommendation. The table lists both the 
applicant's name and the referee's name, the date the letter was submitted, and a 
link to the letter itself. The "Select Applicant" column contains a list of the
applicants' names, as entered by the applicants themselves on the application
submission page. The "Move" buttons in the "Move Letter" column can be used to move 
a letter into the appropriate applicant's directory.

The letters are often submitted before the applications, so you may see several 
letters for an applicant before their name shows up in the "Select Applicant" 
column.

To move a letter, select the appropriate applicant's name in the "Select Applicant"
column and then press the "Move" button. The applicant's name in the "Select
Applicant" column might not exactly match the name in the "Applicant Name" column
because the former was entered by the applicant and the latter was entered by
the referee.

Once the letters are moved to an applicant's directory, the "1", "2", and "3" links
will become active in the "Letters" column in the "View Applications" page.  Once
all the letters have been moved, you can start creating the final versions of the
application as described in the previous section.
