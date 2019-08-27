SUMMARY
-------

Thank you for this opportunity to present my code to you. I had a lot of fun with this little project. 

* To run, please just go to the "root" location / index.php. 
* The config.ini file stores the location of the instructions file.
* PLEASE NOTE: I have not tested my test cases. I don't have phpUnit installed on my Docker image that I was using and decided to spend my time on
	writing and testing the code rather than testing the test cases. I'm not sure that the "expectException" works as I hope.
* My solution is perhaps a little over engineered by using a class for the robot, but I wanted to do this to demonstrate a bit more of my skills.
* I have written the code first before the test cases, which made some of the test cases a little "awkward" because much of my validation is done in the construct
	of the robot class.
* I have used "echo" for errors instead of logging them in the error log as I assumed this could be used in a command line.
* I have hardcoded the instructions file in the code rather than using a parameter or ini file just out of convenience, but I could have done either. I recognise that hard
	coding variables like these is "bad practice" but assumed this was not the sort of detail you were looking for.
* I have allowed all instruction to be of any "case" (upper or lower) by converting to lower case.
