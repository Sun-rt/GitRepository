#ifndef DATABASEINFODIALOG_H
#define DATABASEINFODIALOG_H

#include <QDialog>
#include <QTreeWidgetItem>
#include <QSqlQueryModel>

namespace Ui {
class DataBaseInfoDialog;
}

class DataBaseInfoDialog : public QDialog
{
    Q_OBJECT

public:
    DataBaseInfoDialog(QString hostName, QString userName, QString password, QWidget *parent = 0);
    ~DataBaseInfoDialog();

  public slots:
    void showTable(QTreeWidgetItem *item, int column);

private:
    Ui::DataBaseInfoDialog *ui;
    QString userName;
    QString hostName;
    QString password;
    QSqlQueryModel *m_pModel;
};

#endif // DATABASEINFODIALOG_H
