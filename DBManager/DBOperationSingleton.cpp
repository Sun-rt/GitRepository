#include "DBOperationSingleton.h"
#include <QMessageBox>
#include <QApplication>

DBOperationSingleton *DBOperationSingleton::m_pInstance = nullptr;

DBOperationSingleton *DBOperationSingleton::getInstance()
{
    if(m_pInstance == nullptr)
    {
        m_pInstance = new DBOperationSingleton;
    }
    return m_pInstance;
}

QStringList *DBOperationSingleton::getDBName(QString hostName, QString userName, QString password)
{
    db = QSqlDatabase::addDatabase("QMYSQL");
    db.setHostName(hostName);
    db.setUserName(userName);
    db.setPassword(password);

    QStringList *dbList = new QStringList;
    if(db.open())
    {
        QSqlQuery query;
        query.exec("SHOW DATABASES");
        while(query.next())
        {
            QString name = query.value(0).toString();
            dbList->append(name);
            qDebug()<<name;
        }
        return dbList;
    }
    else
    {
        QMessageBox::warning(QApplication::activeWindow(),QStringLiteral("警告"),QStringLiteral("数据库打开失败"));
        return nullptr;
    }
}

bool DBOperationSingleton::openDB(QString &dbName)
{
    db.setDatabaseName(dbName);

    if(db.open())
    {
        return true;
    }
    else
    {
        return false;
    }
}
void DBOperationSingleton::closeDB()
{
    if(db.open())
    {
        db.close();
    }
}

QStringList DBOperationSingleton::getTableName()
{
    if(db.open())
    {
        return db.tables();
    }
    else
    {
        QStringList varList;
        return varList;
    }
}

QString *DBOperationSingleton::queryDB(QString &sqlSentence)
{
    if(!db.open())
    {
        return nullptr;
    }
    QString *queryStr = new QString;

    QSqlQuery query;
    query.exec(sqlSentence);
    if(query.next())
    {
        int rowNum = query.at();
        qDebug()<<rowNum;
        int columnNum = query.record().count();
        for(int i = 0; i < columnNum; ++i)
        {
            QString queryValue = query.value(i).toString();
            queryStr->append(queryValue);
            queryStr->append(",");
        }
        queryStr->append(";");
    }
    return queryStr;
}

bool DBOperationSingleton::addTable(QString &sqlSentence)
{
    if(!db.open())
    {
        return false;
    }
    QSqlQuery query;
    bool bVar = query.exec(sqlSentence);
    return bVar;
}

bool DBOperationSingleton::insertDB(QString &sqlSentence)
{
    if(!db.open())
    {
        return false;
    }
    QSqlQuery query;
    bool bVar = query.exec(sqlSentence);
    return bVar;
}

bool DBOperationSingleton::deleteDBData(QString &sqlSentence)
{
    if(!db.open())
    {
        return false;
    }
    QSqlQuery query;
    bool bVar = query.exec(sqlSentence);
    return bVar;
}

bool DBOperationSingleton::updateDB(QString &sqlSentence)
{
    if(!db.open())
    {
        return false;
    }
    QSqlQuery query;
    bool bVar = query.exec(sqlSentence);
    return bVar;
}
