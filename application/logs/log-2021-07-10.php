<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-07-10 11:12:28 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:12:28 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:12:39 --> Query error: Unknown column 'trn_employeeworkschedules.isActive' in 'field list' - Invalid query: SELECT `trn_employeeworkschedules`.`isActive` as `status`, `trn_employeeworkschedules`.*, `mst_employees`.`employeeCode`, `mst_employees`.`employeeFName`, `mst_employees`.`employeeLName`, `sys_workscheduletypes`.`workScheduleTypeName`, `mst_workschedules`.`workScheduleCode`, `mst_workschedules`.`workScheduleName`, `mst_holidays`.`holidayName`, `mst_vacations`.`vacationName`
FROM `trn_employeeworkschedules`
LEFT JOIN `mst_employees` ON `trn_employeeworkschedules`.`employee` = `mst_employees`.`employeeId`
LEFT JOIN `sys_workscheduletypes` ON `trn_employeeworkschedules`.`workScheduleType` = `sys_workscheduletypes`.`workscheduleTypeId`
LEFT JOIN `mst_workschedules` ON `trn_employeeworkschedules`.`workSchedule` = `mst_workschedules`.`workScheduleId`
LEFT JOIN `mst_holidays` ON `trn_employeeworkschedules`.`holiday` = `mst_holidays`.`holidayId`
LEFT JOIN `mst_vacations` ON `trn_employeeworkschedules`.`vacation` = `mst_vacations`.`vacationId`
WHERE `date` = '2021-07-10'
ORDER BY `orderId` DESC
ERROR - 2021-07-10 11:13:22 --> Query error: Unknown column 'orderId' in 'order clause' - Invalid query: SELECT `trn_employeeworkschedules`.*, `mst_employees`.`employeeCode`, `mst_employees`.`employeeFName`, `mst_employees`.`employeeLName`, `sys_workscheduletypes`.`workScheduleTypeName`, `mst_workschedules`.`workScheduleCode`, `mst_workschedules`.`workScheduleName`, `mst_holidays`.`holidayName`, `mst_vacations`.`vacationName`
FROM `trn_employeeworkschedules`
LEFT JOIN `mst_employees` ON `trn_employeeworkschedules`.`employee` = `mst_employees`.`employeeId`
LEFT JOIN `sys_workscheduletypes` ON `trn_employeeworkschedules`.`workScheduleType` = `sys_workscheduletypes`.`workscheduleTypeId`
LEFT JOIN `mst_workschedules` ON `trn_employeeworkschedules`.`workSchedule` = `mst_workschedules`.`workScheduleId`
LEFT JOIN `mst_holidays` ON `trn_employeeworkschedules`.`holiday` = `mst_holidays`.`holidayId`
LEFT JOIN `mst_vacations` ON `trn_employeeworkschedules`.`vacation` = `mst_vacations`.`vacationId`
WHERE `date` = '2021-07-10'
ORDER BY `orderId` DESC
ERROR - 2021-07-10 11:14:14 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:14:14 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:14:55 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:14:55 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:16:32 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:16:32 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:19:02 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:19:02 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:20:00 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:20:00 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:23:46 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:23:46 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:23:46 --> Severity: Notice --> Undefined variable: loginRedirect C:\Projects\hextimesheet\application\views\transactions\assignedws\assignedws.php 11
ERROR - 2021-07-10 11:24:34 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:24:34 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:25:46 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:25:46 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:26:21 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:26:21 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:29:49 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:29:49 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:30:46 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:30:46 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:31:11 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:31:11 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:33:28 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:33:28 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:56:32 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:56:32 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:56:45 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:56:45 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:57:02 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:57:02 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:57:15 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 11:57:15 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 11:59:09 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 11:59:09 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:00:07 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:00:07 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:00:08 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:00:08 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:00:49 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:00:49 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:01:24 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:01:24 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:01:25 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:01:25 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:01:59 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:01:59 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:02:01 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:02:01 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:03:01 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:03:01 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:03:02 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:03:02 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:03:39 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:03:39 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:03:40 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:03:40 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:05:11 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:05:11 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:05:12 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:05:13 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:05:33 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:05:33 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:05:35 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:05:35 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:05:54 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:05:54 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:05:56 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:05:56 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:17:33 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:17:33 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:17:34 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:17:35 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:18:15 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:18:15 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:20:44 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:20:44 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:20:44 --> Severity: error --> Exception: syntax error, unexpected '=', expecting ')' C:\Projects\hextimesheet\application\views\transactions\assignedws\assignedws.php 38
ERROR - 2021-07-10 12:21:05 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:21:05 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:25:49 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:25:49 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:26:35 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:26:35 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:30:49 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:30:49 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:39:41 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:39:41 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:39:44 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:39:44 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:39:46 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:39:46 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:39:46 --> Severity: Notice --> Undefined variable: loginRedirectAdd C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 11
ERROR - 2021-07-10 12:39:46 --> Severity: Notice --> Undefined variable: loginRedirectCSV C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 17
ERROR - 2021-07-10 12:39:46 --> Severity: Notice --> Undefined variable: employees C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 83
ERROR - 2021-07-10 12:40:36 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:40:36 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:40:36 --> Severity: Notice --> Undefined variable: loginRedirectDownload C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 11
ERROR - 2021-07-10 12:40:36 --> Severity: Notice --> Undefined variable: employees C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 83
ERROR - 2021-07-10 12:40:47 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:40:47 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:40:47 --> Severity: Notice --> Undefined variable: employees C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 83
ERROR - 2021-07-10 12:41:20 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:41:20 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:41:20 --> Severity: Notice --> Undefined variable: employees C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 83
ERROR - 2021-07-10 12:42:18 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:42:18 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:42:18 --> Severity: Notice --> Undefined variable: employees C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 85
ERROR - 2021-07-10 12:42:31 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:42:31 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:42:37 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:42:37 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 12:44:09 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:44:09 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:44:09 --> Severity: Notice --> Undefined variable: employees C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 85
ERROR - 2021-07-10 12:44:43 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:44:43 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:44:43 --> Severity: Notice --> Undefined variable: employees C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 85
ERROR - 2021-07-10 12:46:30 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:46:30 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:46:30 --> Severity: Notice --> Undefined variable: employees C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 85
ERROR - 2021-07-10 12:47:16 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:47:17 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:47:17 --> Severity: Notice --> Undefined variable: employees C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 85
ERROR - 2021-07-10 12:48:06 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:48:06 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:48:06 --> Severity: Notice --> Undefined variable: employees C:\Projects\hextimesheet\application\views\transactions\assignedws\addemployeesws.php 92
ERROR - 2021-07-10 12:50:13 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:50:13 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:51:44 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:51:44 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:52:09 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:52:09 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:53:17 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:53:17 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 12:55:06 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 12:55:06 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:12:19 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:12:19 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:12:27 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:12:27 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:13:00 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:13:00 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:13:01 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:13:01 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:13:40 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:13:40 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:13:41 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:13:41 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:13:50 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:13:50 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:14:24 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:14:24 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:14:25 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:14:25 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:14:59 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:14:59 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:15:00 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:15:00 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:15:06 --> Severity: Notice --> Undefined index: deptartment C:\Projects\hextimesheet\application\controllers\transactions\AssignWS.php 97
ERROR - 2021-07-10 13:15:41 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:15:41 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:15:42 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:15:42 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:16:35 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:16:35 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:19:17 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:19:17 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:19:34 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:19:34 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:20:37 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:20:37 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:21:03 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:21:03 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:29:45 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:29:45 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:29:51 --> Severity: Notice --> Undefined index: workScheduleId C:\Projects\hextimesheet\application\controllers\transactions\AssignWS.php 136
ERROR - 2021-07-10 13:29:51 --> Severity: Notice --> Undefined index: workScheduleName C:\Projects\hextimesheet\application\controllers\transactions\AssignWS.php 136
ERROR - 2021-07-10 13:30:21 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:30:21 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:30:42 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:30:42 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:30:43 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:30:43 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:30:48 --> Severity: Notice --> Undefined index: workScheduleId C:\Projects\hextimesheet\application\controllers\transactions\AssignWS.php 136
ERROR - 2021-07-10 13:30:48 --> Severity: Notice --> Undefined index: workScheduleName C:\Projects\hextimesheet\application\controllers\transactions\AssignWS.php 136
ERROR - 2021-07-10 13:31:04 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:31:04 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:31:05 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:31:05 --> 404 Page Not Found: Assets/plugins
ERROR - 2021-07-10 13:31:11 --> Severity: Notice --> Undefined index: workScheduleId C:\Projects\hextimesheet\application\controllers\transactions\AssignWS.php 136
ERROR - 2021-07-10 13:31:11 --> Severity: Notice --> Undefined index: workScheduleName C:\Projects\hextimesheet\application\controllers\transactions\AssignWS.php 136
ERROR - 2021-07-10 13:33:52 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:33:52 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
ERROR - 2021-07-10 13:35:22 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 359
ERROR - 2021-07-10 13:35:22 --> Severity: Notice --> Undefined variable: notifications C:\Projects\hextimesheet\application\views\admin\templates\header.php 434
