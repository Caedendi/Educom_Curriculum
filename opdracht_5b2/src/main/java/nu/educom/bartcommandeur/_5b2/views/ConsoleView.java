package nu.educom.bartcommandeur._5b2.views;

import nu.educom.bartcommandeur._5b2.presenters.ILoginReceivedListener;

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
                endProgram();
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
    public void initializeProgram() {
        displayMessage("MISix2 ConsoleView started.");
        displayMessage("To exit, submit \"exit\" as ID.");
        displayMessage("");
    }

    @Override
    public void displayMessage(String message) {
        System.out.println(message);
    }

    @Override
    public void getIdInput() {
        displayMessage("Please insert your ID.");
        String id = scanner.nextLine();
        displayMessage("");

        if (id.equalsIgnoreCase(("exit"))) {
            for (ILoginReceivedListener lis : listeners) {
                lis.exitReceived(); }
        } else {
            for (ILoginReceivedListener lis : listeners) {
                lis.inputReceived(id, null); }
        }
    }

    @Override
    public void getPasswordInput() {
        displayMessage("Please enter your password.");
        String pwd = scanner.nextLine();
        displayMessage("");

        for (ILoginReceivedListener lis : listeners) {
            lis.inputReceived(null, pwd); }
    }

    @Override
    public void endProgram() {
        displayMessage("Exiting program. Press Enter to continue.");
        scanner.nextLine();
        System.exit(0);
    }
}
