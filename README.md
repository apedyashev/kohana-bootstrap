kohana-bootstrap
================

bootstrap for my kohana 3.3 projects
------------------------------------

Controllers:
------------

  - To create controller that allows access only for authenticated users, you should  extend you controller from *My_LoggedUsersController*
  - To create controller that allows access only for users with administrative priveleges, you should  extend you controller from *My_AdminController*
  
Helpers:
--------
  - *Helper_Alert* Gets/Sets alerts messages and CSS classes to render in view
  - *Helper_Auth*  Incapsulates authentication feautures
  - *Helper_Date*  Contains a number of methods for formatting and manipulations with dates
  - *Helper_HeadImport*  Allows to manage your assets from controller. TDB: JS/CSS compression will be added later
  - *Helper_Js*  exports PHP variables int JS varibles
  - *Helper_Json*  Helps to send JSON  in identical  format
  - *Helper_Output*  Helper for output data to the browser
  - *Helper_User*  User related methods
