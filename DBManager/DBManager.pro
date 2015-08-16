#-------------------------------------------------
#
# Project created by QtCreator 2015-07-21T23:45:31
#
#-------------------------------------------------

QT       += core gui
QT       += sql

greaterThan(QT_MAJOR_VERSION, 4): QT += widgets

TARGET = DBManager
TEMPLATE = app


SOURCES += main.cpp\
        mainwindow.cpp \
    DBOperationSingleton.cpp \
    BasicInfoDialog.cpp \
    DataBaseInfoDialog.cpp

HEADERS  += mainwindow.h \
    DBOperationSingleton.h \
    BasicInfoDialog.h \
    DataBaseInfoDialog.h

FORMS    += mainwindow.ui \
    BasicInfoDialog.ui \
    DataBaseInfoDialog.ui
