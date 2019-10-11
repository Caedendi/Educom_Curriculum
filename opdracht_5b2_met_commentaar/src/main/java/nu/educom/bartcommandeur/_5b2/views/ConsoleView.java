package nu.educom.bartcommandeur._5b2.views;

import nu.educom.bartcommandeur._5b2.presenters.MISixPresenter;
import nu.educom.bartcommandeur._5b2.presenters.ILoginReceivedListener;

import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

public class ConsoleView implements IMISixInput {
    private List<ILoginReceivedListener> listeners;
    private DisplayState currentState;
    Scanner scanner; /* JH: Scanner is een resource die ook weer moet worden gesloten als deze view wordt vernietigd */

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
            /* JH TIP: Zet onderstaande code in een functie */
            for (ILoginReceivedListener lis : listeners) {
                lis.exitReceived(); } /* JH: Zet voor de leesbaarheid het } op de volgende regel */
        } else {
            /* JH TIP: Zet onderstaande code in een functie */
            for (ILoginReceivedListener lis : listeners) {
                lis.inputReceived(id, null); } /* JH: Zet voor de leesbaarheid het } op de volgende regel */
        }
    }

    @Override
    public void getPasswordInput() {
        displayMessage("Please enter your password.");
        String pwd = scanner.nextLine();
        displayMessage("");

        /* JH: Het zou handig zijn om ook hier het woord exit toe af te handelen als exit received */
        for (ILoginReceivedListener lis : listeners) {
            /* JH TIP: Zet onderstaande code in een functie */
            lis.inputReceived(null, pwd); } /* JH: Zet voor de leesbaarheid het } op de volgende regel */
    }

    @Override
    public void endProgram() {
        displayMessage("Exiting program. Press Enter to continue.");
        scanner.nextLine();
        /* JH: Roep scanner.close(); aan voordat je exit */
        System.exit(0);
    }
}
