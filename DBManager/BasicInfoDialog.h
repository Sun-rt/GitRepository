#ifndef BASICINFODIALOG_H
#define BASICINFODIALOG_H

#include <QDialog>

namespace Ui {
class BasicInfoDialog;
}

class BasicInfoDialog : public QDialog
{
    Q_OBJECT

public:
    explicit BasicInfoDialog(QWidget *parent = 0);
    ~BasicInfoDialog();

public:
    QString getLocalHost();
    QString getUserName();
    QString getPassWord();

private:
    Ui::BasicInfoDialog *ui;
};

#endif // BASICINFODIALOG_H
