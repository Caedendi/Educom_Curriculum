package nu.educom.bartcommandeur._5b2_5b3.views;

import nu.educom.bartcommandeur._5b2_5b3.presenters.ILoginReceivedListener;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.ArrayList;
import java.util.List;

class LoginPanel {
    private JPanel pnlMain;
    private List<ILoginReceivedListener> listeners;

    private static final Insets WEST_INSETS = new Insets(5, 0, 5, 5);
    private static final Insets EAST_INSETS = new Insets(5, 5, 5, 0);

    private GridBagConstraints gbc;

    private JLabel labelId, labelPass;
    private JTextField tfId, tfPass;
    private JButton loginButton;
    private JButton cancelButton;

    public LoginPanel() {
        listeners = new ArrayList<ILoginReceivedListener>();

        pnlMain = new JPanel();
        pnlMain.setLayout(new GridBagLayout());
        pnlMain.setBorder(BorderFactory.createCompoundBorder(
                BorderFactory.createTitledBorder("Login"),
                BorderFactory.createEmptyBorder(5, 5, 5, 5)));

        // specify components
        // ID label
        labelId = new JLabel("ID:");
        pnlMain.add(labelId, createGbc(0, 0));

        // ID textfield
        tfId = new JTextField();
        pnlMain.add(tfId, createGbc(1, 0, 3, 1, true));

        // Password label
        labelPass = new JLabel("Password:");
        pnlMain.add(labelPass, createGbc(0, 1));

        // Password textfield
        tfPass = new JPasswordField(20);
        pnlMain.add(tfPass, createGbc(1, 1, 3, 1, true));

        // Login button
        loginButton = new JButton("Login");
        loginButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                String id = tfId.getText();
                String pwd = tfPass.getText();
                for (ILoginReceivedListener lis : listeners) {
                    lis.inputReceived(id, pwd);
                }
            }
        });
        pnlMain.add(loginButton, createGbc(3, 2, 1,1,false));

        // Cancel button
        cancelButton = new JButton("Exit");
        cancelButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                for (ILoginReceivedListener lis : listeners) {
                    lis.exitReceived(); }
            }
        });
        pnlMain.add(cancelButton, createGbc(0, 2, 1, 1, false));
    }

    public void addILoginReceivedListener(ILoginReceivedListener lis) {
        listeners.add(lis);
    }

    private GridBagConstraints createGbc(int x, int y, int width, int height, boolean fillHorizontal) {
        gbc = new GridBagConstraints();

        //gbc.anchor = (x == 0) ? GridBagConstraints.WEST : GridBagConstraints.EAST;
        gbc.fill = (fillHorizontal) ? GridBagConstraints.HORIZONTAL : GridBagConstraints.WEST;

        gbc.gridwidth = width;
        gbc.gridheight = height;
        gbc.gridx = x;
        gbc.gridy = y;

        gbc.insets = (x == 0) ? new Insets(5, 0, 5, 5) : new Insets(5, 5, 5, 0);
        gbc.weightx = 1; // (x == 0) ? 0.1 : 1.0;
        //gbc.weighty = 1.0;
        return gbc;
    }

    private GridBagConstraints createGbc(int x, int y) {
        return createGbc(x, y, 1, 1, true);
    }

    public void setLoginButtonIsVisible(boolean isVisible) {
        loginButton.setVisible(isVisible);
    }

    public JPanel getPanel() {
        return pnlMain;
    }
}