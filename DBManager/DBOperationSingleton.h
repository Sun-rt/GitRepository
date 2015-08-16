#ifndef DBOPERATIONSINGLETON_H
#define DBOPERATIONSINGLETON_H

#include <QtSql>
#include <QStringList>

class DBOperationSingleton
{
private:
    DBOperationSingleton()
    {}

public:
    static DBOperationSingleton *getInstance();

    //创建数据库
    bool createDB(QString *dbName);
    //得到数据库名称
    QStringList *getDBName(QString hostName, QString userName, QString password);
    //得到表名称
    QStringList getTableName();
    //打开数据库
    bool openDB(QString &dbName);
    //关闭数据库
    void closeDB();
    //数据库查询
    QString *queryDB(QString &sqlSentence);
    //添加表
    bool addTable(QString &sqlSentence);
    //数据库插入
    bool insertDB(QString &sqlSentence);
    //数据库删除记录
    bool deleteDBData(QString &sqlSentence);
    //更新记录
    bool updateDB(QString &sqlSentence);

private:
    static DBOperationSingleton *m_pInstance;
    QSqlDatabase db;
};

#endif // DBOPERATIONSINGLETON_H
