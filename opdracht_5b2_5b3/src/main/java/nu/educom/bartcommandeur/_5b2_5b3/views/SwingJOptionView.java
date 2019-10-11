package nu.educom.bartcommandeur._5b2_5b3.views;

import nu.educom.bartcommandeur._5b2_5b3.presenters.ILoginReceivedListener;

import javax.swing.*;
import java.util.ArrayList;
import java.util.List;


public class SwingJOptionView implements IMISixInput {
    private List<ILoginReceivedListener> listeners;
    private DisplayState currentState;

    public SwingJOptionView() {
        listeners = new ArrayList<ILoginReceivedListener>();
    }

    @Override
    public void addILoginReceivedListener(ILoginReceivedListener lis) {
        listeners.add(lis);
    }

    @Override
    public void initializeProgram() {
        displayMessage("MISix2 SwingJOptionView started.");
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
            case EXIT:
                endProgram();
                break;
        }
    }

    public void getIdInput() {
        String id = JOptionPane.showInputDialog("Please enter your ID.");

        if( id == null ) { // if cancel button pressed
            raiseExitReceivedEvent();
        } else {
            raiseInputReceivedEvent(id, null);
        }
    }

    public void getPasswordInput() {
        String pwd = JOptionPane.showInputDialog("Please enter your password.");

        if( pwd == null ) { // if cancel button pressed
            raiseExitReceivedEvent();
        } else {
            raiseInputReceivedEvent(null, pwd);
        }
    }

    private void raiseExitReceivedEvent() {
        for (ILoginReceivedListener lis : listeners) {
            lis.exitReceived(); }
    }

    private void raiseInputReceivedEvent(String id, String pwd) {
        for (ILoginReceivedListener lis : listeners) {
            lis.inputReceived(id, pwd); }
    }

    @Override
    public void displayMessage(String message) {
        JOptionPane.showMessageDialog(null, message);
    }

    @Override
    public void endProgram() {
        displayMessage("Exiting program.");
        System.exit(0);
    }
}