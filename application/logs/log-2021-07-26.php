<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-07-26 12:52:11 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 12:52:11 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 12:52:20 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 12:52:20 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 12:52:26 --> Query error: Unknown column 'trn_leaverequests.isActive' in 'field list' - Invalid query: SELECT `trn_leaverequests`.`isActive` as `status`, `trn_leaverequests`.*, `mst_employees`.`employeeCode`, `mst_employees`.`employeeFName`, `mst_employees`.`employeeLName`, `approver`.`employeeCode` as `approverCode`, `approver`.`employeeFName` as `approverFName`, `approver`.`employeeLName` as `approverLName`
FROM `trn_leaverequests`
LEFT JOIN `mst_employees` ON `trn_leaverequests`.`employee` = `mst_employees`.`employeeId`
LEFT JOIN `mst_leavetypes` ON `trn_leaverequests`.`leaveType` = `mst_leavetypes`.`leaveTypeId`
LEFT JOIN `mst_employees` `approver` ON `trn_leaverequests`.`approvedUser` = `approver`.`employeeId`
WHERE `isDeleted` = 0
ERROR - 2021-07-26 12:53:05 --> Query error: Unknown column 'trn_leaverequests.isActive' in 'field list' - Invalid query: SELECT `trn_leaverequests`.`isActive` as `status`, `trn_leaverequests`.*, `mst_employees`.`employeeCode`, `mst_employees`.`employeeFName`, `mst_employees`.`employeeLName`, `approver`.`employeeCode` as `approverCode`, `approver`.`employeeFName` as `approverFName`, `approver`.`employeeLName` as `approverLName`
FROM `trn_leaverequests`
LEFT JOIN `mst_employees` ON `trn_leaverequests`.`employee` = `mst_employees`.`employeeId`
LEFT JOIN `mst_leavetypes` ON `trn_leaverequests`.`leaveType` = `mst_leavetypes`.`leaveTypeId`
LEFT JOIN `mst_employees` `approver` ON `trn_leaverequests`.`approvedUser` = `approver`.`employeeId`
WHERE 0 = ''
ERROR - 2021-07-26 12:53:10 --> Query error: Unknown column 'trn_leaverequests.isActive' in 'field list' - Invalid query: SELECT `trn_leaverequests`.`isActive` as `status`, `trn_leaverequests`.*, `mst_employees`.`employeeCode`, `mst_employees`.`employeeFName`, `mst_employees`.`employeeLName`, `approver`.`employeeCode` as `approverCode`, `approver`.`employeeFName` as `approverFName`, `approver`.`employeeLName` as `approverLName`
FROM `trn_leaverequests`
LEFT JOIN `mst_employees` ON `trn_leaverequests`.`employee` = `mst_employees`.`employeeId`
LEFT JOIN `mst_leavetypes` ON `trn_leaverequests`.`leaveType` = `mst_leavetypes`.`leaveTypeId`
LEFT JOIN `mst_employees` `approver` ON `trn_leaverequests`.`approvedUser` = `approver`.`employeeId`
WHERE 0 = ''
ERROR - 2021-07-26 12:54:44 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 12:54:44 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 12:55:24 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 12:55:24 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 13:42:49 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 13:42:49 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 13:42:49 --> Severity: Notice --> Undefined index: leaveTypeName C:\Projects\hextimesheet\application\views\transactions\leaverequests\leaverequests.php 37
ERROR - 2021-07-26 13:43:48 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 13:43:48 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 13:44:47 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 13:44:47 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:06:09 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:06:09 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:07:40 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:07:40 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:08:02 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:08:02 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:13:49 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:13:49 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:14:12 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-26 14:14:12 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-26 14:15:19 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:15:19 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:15:23 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-26 14:15:23 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-26 14:16:03 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:16:03 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:16:08 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-26 14:16:08 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-26 14:16:39 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:16:39 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:17:41 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:17:41 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:19:56 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:19:56 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:36:14 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:36:14 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:36:31 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:36:31 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:37:07 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:37:07 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:37:12 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:37:12 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:37:19 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:37:19 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:40:09 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:40:09 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:40:17 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:40:17 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:42:47 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:42:47 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:42:54 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:42:54 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 14:43:03 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 14:43:03 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 15:00:14 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 15:00:14 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 15:00:19 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 15:00:19 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 15:00:30 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 15:00:30 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-26 15:00:35 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-26 15:00:35 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
