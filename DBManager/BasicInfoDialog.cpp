#include "BasicInfoDialog.h"
#include "ui_BasicInfoDialog.h"

BasicInfoDialog::BasicInfoDialog(QWidget *parent) :
    QDialog(parent),
    ui(new Ui::BasicInfoDialog)
{
    ui->setupUi(this);
}

BasicInfoDialog::~BasicInfoDialog()
{
    delete ui;
}

QString BasicInfoDialog::getLocalHost()
{
    return ui->lineEdit1->text().trimmed();
}

QString BasicInfoDialog::getUserName()
{
    return ui->lineEdit2->text().trimmed();
}

QString BasicInfoDialog::getPassWord()
{
    return ui->lineEdit3->text().trimmed();
}
