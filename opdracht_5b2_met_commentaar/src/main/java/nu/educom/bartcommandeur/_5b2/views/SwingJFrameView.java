package nu.educom.bartcommandeur._5b2.views;

import nu.educom.bartcommandeur._5b2.presenters.ILoginReceivedListener;

import javax.swing.*;
import java.awt.*;
import java.awt.event.WindowEvent;
import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.TimeUnit;

import static javax.swing.SwingConstants.CENTER;
import static javax.swing.SwingConstants.HORIZONTAL;

public class SwingJFrameView implements IMISixInput {
    private Dimension dim = Toolkit.getDefaultToolkit().getScreenSize();

    private JFrame frame;
    private JPanel pnlMain;
    private MessagePanel pnlMsg;
    private LoginPanel pnlLogin;
//    private List<ILoginReceivedListener> listeners;
    private DisplayState currentState;

    private static final Insets INSETS_LEFT = new Insets(5, 5, 5, 5);
    private static final Insets INSETS_RIGHT = new Insets(5, 5, 5, 5);
    private static final Insets INSETS_MIDDLE = new Insets(5, 5, 5, 5);

    // Maak gebruik van JFrame, JLabel en JTextFields om de invoer van de gebruiker te vragen, en een JButton om de verwerking te starten.
    // Indien het inloggen niet lukt komt er te staan "ACCESS DENIED"
    // Indien het inloggen wel lukt komt er te staan dat het inloggen is gelukt.
    // use main panel
    //
    // structure
    // https://stackoverflow.com/questions/17204760/how-can-i-make-a-component-span-multiple-cells-in-a-gridbaglayout
    //
    // inspiration (see top answer)
    // https://stackoverflow.com/questions/9851688/how-to-align-left-or-right-inside-gridbaglayout-cell
    //
    public SwingJFrameView() {
//        listeners = new ArrayList<ILoginReceivedListener>(); /* JH Remove old code */
        frame = new JFrame("MI6");
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        pnlMain = new JPanel();
        pnlMain.setLayout(new BoxLayout(pnlMain, BoxLayout.Y_AXIS));
        pnlMsg = new MessagePanel();
        pnlLogin = new LoginPanel();
    }

    @Override
    public void initializeProgram() {
        pnlMain.add(pnlMsg.getPanel());
        pnlMain.add(pnlLogin.getPanel());
        frame.getContentPane().add(pnlMain);
        frame.pack();
        frame.setLocation(dim.width/2 - frame.getSize().width/2, dim.height/2 - frame.getSize().height/2);
        frame.setVisible(true);
    }

    @Override
    public void addILoginReceivedListener(ILoginReceivedListener lis) {
//        listeners.add(lis); /* JH Remove old code */
        pnlLogin.addILoginReceivedListener(lis);
    }

    @Override
    public DisplayState getDisplayState() {
        return currentState;
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
                getIdInput();
                break;
            case ASK_PASSWORD:
                getPasswordInput();
                break;
            case ON_LOGIN:

                break;
            case ERROR:
                // todo
                break;
            case EXIT:
                endProgram();
                break;
        }
    }

    @Override
    public void displayMessage(String message) {
        pnlMsg.displayMessage(message);
        if( message.contains("your access has been granted.") ) {
            pnlMsg.setColor(Color.GREEN);
        }
        else if( message.contains("Exit") ) {
            pnlMsg.setColor(Color.BLACK);
        }
        else {
            pnlMsg.setColor(Color.RED);
        }
    }

    public void clearMessage() {
        pnlMsg.clearMessage();
    }

    @Override
    public void getIdInput() {

    }

    @Override
    public void getPasswordInput() {
        return;
    }

    @Override
    public void endProgram() {
        pnlLogin.setLoginButtonVisibility(false);
        displayMessage("Exiting program.");
        System.exit(0); /* JH: Een swing programma mag je nooit met system.exit om zeep helpen.
                                      gebruik frame.dispatchEvent(new WindowEvent(frame, WindowEvent.WINDOW_CLOSING)); to trigger a close action */
    }
}
