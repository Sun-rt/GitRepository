#include "DataBaseInfoDialog.h"
#include "ui_DataBaseInfoDialog.h"
#include "DBOperationSingleton.h"
#include <QSqlQueryModel>

DataBaseInfoDialog::DataBaseInfoDialog(QString hostName, QString userName, QString password, QWidget *parent) :
    ui(new Ui::DataBaseInfoDialog), QDialog(parent),hostName(hostName), userName(userName), password(password), m_pModel(nullptr)
{
    ui->setupUi(this);
    DBOperationSingleton *operSingle = DBOperationSingleton::getInstance();
    QStringList *dbNameList = operSingle->getDBName(hostName, userName, password);
    for(int i = 0; i < dbNameList->size(); ++i)
    {
        QString dbName = dbNameList->at(i);
        QStringList varList;
        varList.append(dbName);
        QTreeWidgetItem *item = new QTreeWidgetItem(ui->treeWidget, varList);
        ui->treeWidget->addTopLevelItem(item);

        operSingle->openDB(dbName);
        QStringList tableNameList = operSingle->getTableName();
        for(int j = 0; j < tableNameList.size(); ++j)
        {
            QStringList tableList;
            tableList.append(tableNameList.at(j));
            QTreeWidgetItem *citem = new QTreeWidgetItem(item, tableList);
            item->addChild(citem);
        }
        operSingle->closeDB();
    }
    connect(ui->treeWidget, SIGNAL(itemDoubleClicked(QTreeWidgetItem*,int)), this, SLOT(showTable(QTreeWidgetItem*,int)));
    m_pModel = new QSqlQueryModel(ui->tableView);
}

DataBaseInfoDialog::~DataBaseInfoDialog()
{
    delete ui;
}

void DataBaseInfoDialog::showTable(QTreeWidgetItem *item, int column)
{
    QString tableName = item->text(0).trimmed();
    QString dbName = item->parent()->text(0).trimmed();
    DBOperationSingleton *operSingle = DBOperationSingleton::getInstance();
    operSingle->openDB(dbName);
    QString queryStr = QString("select * from %1").arg(tableName);
    m_pModel->clear();
    m_pModel->setQuery(queryStr);
    ui->tableView->setModel(m_pModel);
    operSingle->closeDB();
}
