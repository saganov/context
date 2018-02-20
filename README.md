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

1. Make an application independent from the source and format of its configuration storage
1. Make it possible to store parameters on different sources (CLI, files, HTTP, database etc.) and formats (ini, json, xml, yml etc.)
1. Make it possible to define comprehensive default values
1. Make it possinble to properly convert values to the correct data type

Researching
===========

Existent Libs and Docs:
- [Python Decouple](https://pypi.python.org/pypi/python-decouple) Python library to strict separation of settings from code.
- [12. Utility Conventions](http://pubs.opengroup.org/onlinepubs/9699919799/basedefs/V1_chap12.html) - describes the argument syntax of the standard utilities and introduces terminology used throughout POSIX.1-2008 for describing the arguments processed by the utilities.
- Python Argparse library
- Symfony Command Library

Implementation
==============

Class diagram of prototype:

![Context prototype](http://www.plantuml.com/plantuml/png/TP312i8m38RlUOeUrT4ty31G3vu5xw7DjD1sq6H3KD_Tsgsu7Jmb97--FqdBWac6uC55eTIX8NM-c3i5UaA3rcwsq9W-2hh8tznIXuENA_hIGPOStylfGrRJGux9ZPGov4QJn7XaLfMjdL3WfGMxmlhdC8sVuZZpCu8BgpheHDpxaOeQrcielQjdmHpL_gMrghMLkdH-Jj1IjFb57m00)

<details>
<summary>Source code for PlantUML:</summary>
<p>

```
@startuml
interface IScheme{
+add()
+contains()
+defaultVal()
+cast()
}
interface IContextDriver{
+get()
}
class Scheme{
-items
+add()
+consist()
+defaultVal()
+cast()
}
class EnvContext{
-scheme
+get()
-resolve()
}

IContextDriver -* IScheme
IScheme <|-- Scheme
IContextDriver<|-- EnvContext
@enduml
```

</p>
</details>
