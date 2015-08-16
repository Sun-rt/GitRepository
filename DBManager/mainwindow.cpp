#include "mainwindow.h"
#include "ui_mainwindow.h"
#include "DBOperationSingleton.h"
#include "BasicInfoDialog.h"
#include "DataBaseInfoDialog.h"
#include <QVBoxLayout>

MainWindow::MainWindow(QWidget *parent) :
    QMainWindow(parent),
    ui(new Ui::MainWindow)
{
    ui->setupUi(this);
    BasicInfoDialog *infoDialog = new BasicInfoDialog(this);
    infoDialog->exec();
    QString localhost = infoDialog->getLocalHost();
    QString username = infoDialog->getUserName();
    QString password = infoDialog->getPassWord();
    
    
    DBOperationSingleton *operSingle = DBOperationSingleton::getInstance();

    QStringList *dbNameList = operSingle->getDBName(localhost, username, password);
    
    if(dbNameList->size() == 0)
    {
        return;
    }
    DataBaseInfoDialog *baseInfoDia = new DataBaseInfoDialog(localhost, username, password, this);
    QVBoxLayout *mainLayout = new QVBoxLayout;
    mainLayout->addWidget(baseInfoDia);
    this->centralWidget()->setLayout(mainLayout);

    QString dbName("new_schema");
    bool bVar = operSingle->openDB(dbName);
    qDebug()<<bVar;
}

MainWindow::~MainWindow()
{
    delete ui;
}
