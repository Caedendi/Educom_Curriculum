package nu.educom.bartcommandeur._5b2_5b3.views;

import nu.educom.bartcommandeur._5b2_5b3.presenters.ILoginReceivedListener;

import javax.swing.*;
import java.awt.*;
import java.awt.event.WindowEvent;

public class SwingJFrameView implements IMISixInput {
    private JFrame frame;
    private JPanel pnlMain;
    private MessagePanel pnlMsg;
    private LoginPanel pnlLogin;
    private DisplayState currentState;

    // gebruikte code:
    // https://stackoverflow.com/questions/17204760/how-can-i-make-a-component-span-multiple-cells-in-a-gridbaglayout
    // https://stackoverflow.com/questions/9851688/how-to-align-left-or-right-inside-gridbaglayout-cell
    public SwingJFrameView() {
        frame = new JFrame("MI6");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        pnlMain = new JPanel();
        pnlMain.setLayout(new BoxLayout(pnlMain, BoxLayout.Y_AXIS));
        pnlMsg = new MessagePanel();
        pnlLogin = new LoginPanel();
    }

    @Override
    public void addILoginReceivedListener(ILoginReceivedListener lis) {
        pnlLogin.addILoginReceivedListener(lis);
    }

    @Override
    public void initializeProgram() {
        pnlMain.add(pnlMsg.getPanel());
        pnlMain.add(pnlLogin.getPanel());
        frame.getContentPane().add(pnlMain);
        frame.pack();
        Dimension dim = Toolkit.getDefaultToolkit().getScreenSize();
        frame.setLocation(dim.width/2 - frame.getSize().width/2, dim.height/2 - frame.getSize().height/2);
        frame.setVisible(true);
    }

    @Override
    public void setDisplayState(DisplayState state) {
        currentState = state;
        executeCurrentDisplayState();
    }

    @Override
    public void executeCurrentDisplayState() {
        switch( currentState ) {
            case BOOT:
                initializeProgram();
                break;
            case ASK_ID:
            case ASK_PASSWORD:
                break;
            case ON_LOGIN:
                pnlLogin.setLoginButtonIsVisible(false);
                break;
            case EXIT:
                endProgram();
                break;
        }
    }

    @Override
    public void displayMessage(String msg) {
        pnlMsg.displayMessage(msg);
    }

    @Override
    public void endProgram() {
        pnlLogin.setLoginButtonIsVisible(false);
        displayMessage("Exiting program.");
        frame.dispatchEvent(new WindowEvent(frame, WindowEvent.WINDOW_CLOSING));
    }
}
