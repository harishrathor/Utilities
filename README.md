# Utilities for doing some amazing stuff.


## PHP Utilities

### Utility for creating directories using JSON
* Clone the repo
* Edit JSON file according to your required folder structure. Please do not use array of objects [{},{},...], use only objects.   Each key works as folder name. So, for leaf folder's key give the value "/".
* Edit $separator variable according to your OS environment: '\\' for windows and '/' for linux.
* Edit 'mkdir' function according to your OS: for  Windows remove 077 from mkdir 
* Enter root directory where you want to create the folders.
