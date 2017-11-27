@ECHO OFF
cd /d %~dp0
title 协众OA办公系统安装控制面板
cls 
color 0a
MODE con: COLS=74 LINES=35
:MENU
ECHO. ┏━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┓
ECHO. ┃        协众OA办公系统安装控制面板                                  ┃
ECHO. ┣━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┫
ECHO. ┃                                                                    ┃
ECHO. ┃   1  安装系统守护程序[DOG]                                         ┃
ECHO. ┃   2  删除系统守护程序[DOG]                                         ┃
ECHO. ┃                                                                    ┃
ECHO. ┃   3  安装手机短信守护程序[SMS]                                     ┃
ECHO. ┃   4  删除手机短信守护程序[SMS]                                     ┃
ECHO. ┃                                                                    ┃
ECHO. ┃   5  安装域名解析守护程序[DOMAIN]                                  ┃
ECHO. ┃   6  删除域名解析守护程序[DOMAIN]                                  ┃
ECHO. ┃                                                                    ┃
ECHO. ┃   7  安装邮件服务守护程序[EMAIL]                                   ┃
ECHO. ┃   8  删除邮件服务守护程序[EMAIL]                                   ┃
ECHO. ┃                                                                    ┃
ECHO. ┃   9  安装自动备份程序[BACKUP]                                      ┃
ECHO. ┃   0  删除自动备份程序[BACKUP]                                      ┃
ECHO. ┃                                                                    ┃
ECHO. ┃   a  安装考勤机同步程序[ATT]                                       ┃
ECHO. ┃   b  删除考勤机同步程序[ATT]                                       ┃
ECHO. ┃                                                                    ┃
ECHO. ┃   c  安装邮件提醒同步程序[SENDEMAIL]                               ┃
ECHO. ┃   d  删除邮件提醒同步程序[SENDEMAIL]                               ┃
ECHO. ┃                                                                    ┃
ECHO. ┃   e  安装APP及微信提醒同步程序[APPNOTICE]                          ┃
ECHO. ┃   f  删除APP及微信提醒同步程序[APPNOTICE]                          ┃
ECHO. ┃                                                                    ┃
ECHO. ┃   s  系统服务面板                                                  ┃
ECHO. ┃   q  退   出                                                       ┃
ECHO. ┃                                                                    ┃
ECHO. ┗━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━┛

:CHOICE
set choice=
set /p choice= 请选择: 
IF NOT "%choice%"=="" SET choice=%choice:~0,1%
if /i "%choice%"=="1" goto IDOG
if /i "%choice%"=="2" goto UDOG
if /i "%choice%"=="3" goto ISMS
if /i "%choice%"=="4" goto USMS
if /i "%choice%"=="5" goto IDOMAIN
if /i "%choice%"=="6" goto UDOMAIN
if /i "%choice%"=="7" goto IEMAIL
if /i "%choice%"=="8" goto UEMAIL
if /i "%choice%"=="9" goto IBACKUP
if /i "%choice%"=="0" goto UBACKUP
if /i "%choice%"=="a" goto ATT
if /i "%choice%"=="b" goto UATT
if /i "%choice%"=="c" goto SEND
if /i "%choice%"=="d" goto USEND
if /i "%choice%"=="e" goto APPNOTICE
if /i "%choice%"=="f" goto UAPPNOTICE
if /i "%choice%"=="q" goto END
if /i "%choice%"=="s" goto MSC
cls
goto MENU

:IDOG
cls
..\php\php.exe -c ..\php\php.ini script\dog.install.php
GOTO MENU
:UDOG
cls
..\php\php.exe -c ..\php\php.ini script\dog.uninstall.php
GOTO MENU

:ISMS
cls
..\php\php.exe -c ..\php\php.ini script\sms.install.php
GOTO MENU
:USMS
cls
..\php\php.exe -c ..\php\php.ini script\sms.uninstall.php
GOTO MENU

:IDOMAIN
cls
..\php\php.exe -c ..\php\php.ini script\domain.install.php
GOTO MENU
:UDOMAIN
cls
..\php\php.exe -c ..\php\php.ini script\domain.uninstall.php
GOTO MENU

:IEMAIL
cls
..\php\php.exe -c ..\php\php.ini script\email.install.php
GOTO MENU
:UEMAIL
cls
..\php\php.exe -c ..\php\php.ini script\email.uninstall.php
GOTO MENU

:IBACKUP
cls
..\php\php.exe -c ..\php\php.ini script\backup.install.php
GOTO MENU
:UBACKUP
cls
..\php\php.exe -c ..\php\php.ini script\backup.uninstall.php
GOTO MENU

:ATT
cls
..\php\php.exe -c ..\php\php.ini script\att.install.php
GOTO MENU
:UATT
cls
..\php\php.exe -c ..\php\php.ini script\att.uninstall.php
GOTO MENU

:SEND
cls
..\php\php.exe -c ..\php\php.ini script\sendEmail.install.php
GOTO MENU
:USEND
cls
..\php\php.exe -c ..\php\php.ini script\sendEmail.uninstall.php
GOTO MENU

:APPNOTICE
cls
..\php\php.exe -c ..\php\php.ini script\appAndWechatNotice.install.php
GOTO MENU
:UAPPNOTICE
cls
..\php\php.exe -c ..\php\php.ini script\appAndWechatNotice.uninstall.php
GOTO MENU

:MSC
cls
start services.msc
GOTO MENU

:END
exit