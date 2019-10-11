package nu.educom.bartcommandeur._5b2.views;

import javax.swing.*;
import java.awt.*;

class MessagePanel {
    private JPanel pnlMain;
    private String msg;
    private JLabel lblMsg;

    public MessagePanel() {
        GridBagConstraints gbc = new GridBagConstraints();


        pnlMain = new JPanel();
        msg = " ";
        lblMsg = new JLabel(msg);
        lblMsg.setForeground(Color.RED);
        pnlMain.add(lblMsg, gbc);
    }

    public void displayMessage(String msg) {
        this.msg = msg;
        updateLabel();
    }

    public void clearMessage() {
        this.msg = " ";
    }

    private void updateLabel() {
        if( msg.contains("\n") ) {
            System.out.println(msg);
            msg = "<html>" + msg + "</html>";
            System.out.println(msg);
            msg = msg.replaceAll("\n", "<br/>");
            System.out.println(msg);
        }
        lblMsg.setText(this.msg);
    }

    public void setColor(Color clr) {
        lblMsg.setForeground(clr);
    } /* JH: Het is beter om kleurcodes binnen het panel te houden en allen te zetten of het wel/niet een error is */

    public JPanel getPanel() {
        return pnlMain;
    }
}