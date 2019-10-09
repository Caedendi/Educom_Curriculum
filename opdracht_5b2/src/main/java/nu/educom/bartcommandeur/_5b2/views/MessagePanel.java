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
            msg = "<html>" + msg + "</html>";
            msg = msg.replaceAll("\n", "<br/>");
        }
        lblMsg.setText(this.msg);
    }

    public void setColor(Color clr) {
        lblMsg.setForeground(clr);
    }

    public JPanel getPanel() {
        return pnlMain;
    }
}