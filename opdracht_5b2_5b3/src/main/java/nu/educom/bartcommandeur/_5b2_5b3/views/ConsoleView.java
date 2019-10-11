package nu.educom.bartcommandeur._5b2_5b3.views;

import nu.educom.bartcommandeur._5b2_5b3.presenters.ILoginReceivedListener;

import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class ConsoleView implements IMISixInput {
    private List<ILoginReceivedListener> listeners;
    private DisplayState currentState;
    Scanner scanner;

    public ConsoleView() {
        listeners = new ArrayList<ILoginReceivedListener>();
        scanner = new Scanner(System.in);
    }

    @Override
    public void addILoginReceivedListener(ILoginReceivedListener lis) {
        listeners.add(lis);
    }

    @Override
    public void initializeProgram() {
        displayMessage("MISix2 ConsoleView started.");
        displayMessage("To exit, submit \"exit\" as ID.");
        displayMessage("");
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
        displayMessage("Please insert your ID.");
        String id = scanner.nextLine();
        displayMessage("");

        if (id.equalsIgnoreCase(("exit"))) {
            raiseExitReceivedEvent();
        } else {
            raiseInputReceivedEvent(id, null);
        }
    }

    public void getPasswordInput() {
        displayMessage("Please enter your password.");
        String pwd = scanner.nextLine();
        displayMessage("");

        raiseInputReceivedEvent(null, pwd);
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
        System.out.println(message);
    }

    @Override
    public void endProgram() {
        displayMessage("Exiting program. Press Enter to continue.");
        scanner.nextLine();
        scanner.close();
        System.exit(0);
    }
}
