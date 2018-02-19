Problem statement
=================

To decouple an application from its configuration options that could be retrieved from command line, environment variables, configuration files, HTTP request etc.

Preliminary considerations
==========================

It seems that there are the following objects within the domain:
- an **Application** itself
- an Application execution **Context**
- an Application cnfiguration **Scheme**
- a configuration **Parser**s (command-line parser, configuration-file parser, environmtnt-variables parser etc.)

So, appropriate **Parser** consume **Scheme** and read data from particular source to produce **Context** that could supplied to an **Application**

Business goals
==============

# Make an application independent from the source and format of its configuration storage
# Make it possible to store parameters on different sources (CLI, files, HTTP, database etc.) and formats (ini, json, xml, yml etc.)
# Make it possible to define comprehensive default values
# Make it possinble to properly convert values to the correct data type

Researching
===========

Existent Libs and Docs:
- [Python Decouple](https://pypi.python.org/pypi/python-decouple) Python library to strict separation of settings from code.
- [12. Utility Conventions](http://pubs.opengroup.org/onlinepubs/9699919799/basedefs/V1_chap12.html) - describes the argument syntax of the standard utilities and introduces terminology used throughout POSIX.1-2008 for describing the arguments processed by the utilities.
- Python Argparse library
- Symfony Command Library

