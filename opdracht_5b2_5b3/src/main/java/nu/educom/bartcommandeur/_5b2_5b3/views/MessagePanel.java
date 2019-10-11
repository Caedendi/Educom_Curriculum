package nu.educom.bartcommandeur._5b2_5b3.views;

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
        setColor();
        convertLineBreaks();
        updateLabel();
    }

    public void clearMessage() {
        this.msg = " ";
    }

    private void convertLineBreaks() {
        if( msg.contains("\n") ) {
            msg = "<html>" + msg + "</html>";
            msg = msg.replaceAll("\n", "<br/>");
        }
    }

    private void updateLabel() {
        lblMsg.setText(this.msg);
    }

    // for now, all messages are errors, except the "access granted" and "exit" messages.
    // if this changes, expand on this with a message class, containing a string and a message type.
    // change this function accordingly.
    private void setColor() {
        /* JH: Het is beter om kleurcodes binnen het panel te houden en alleen te zetten of het wel/niet een error is */
        if( msg.contains("your access has been granted.") ) {
            lblMsg.setForeground(Color.GREEN);
        }
        else if( msg.contains("Exit") ) {
            lblMsg.setForeground(Color.BLACK);
        }
        else {
            lblMsg.setForeground(Color.RED);
        }
    }

    public JPanel getPanel() {
        return pnlMain;
    }
}