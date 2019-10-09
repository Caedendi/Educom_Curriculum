package nu.educom.bartcommandeur._5b1_met_commentaar;

import java.util.List;
import java.util.ArrayList;
import java.util.Scanner;

public class MISIX1_review {
    static final int MIN_AGENT_ID = 1;
    static final int MAX_AGENT_ID = 956;
    static final int ID_DIGITS = Integer.toString(MAX_AGENT_ID).length();
    static final String SECRET_PASSWORD = "For ThE Royal QUEEN";

    static Scanner scanner = new Scanner(System.in);
    static List<String> blacklist = new ArrayList<String>();

    public static void main(String[] args) {
        System.out.println("MI SIX STARTED");
        String inputId;
        String inputPassword;

        while(true) {
            inputId = askForId();
            /* JH TIP: Zorg dat er ook een manier is om het programma te verlaten zonder eerst in te loggen */
            if( isNumber(inputId) && isCorrectId(Integer.parseInt(inputId)) ) {
                inputId = addPaddingZeroes(inputId); /* Dit is business logic, maar staat hier in de main functie */
                if( !isBlacklisted(inputId) ) {
                    inputId = approveId(inputId);
                }
                else {
                    /* JH: Mis hier een system.out functie */
                    continue;
                }
            }
            else {
                System.out.println("Incorrect ID.");
                continue;
            }

            inputPassword = askForPassword();
            if( isCorrectPassword(inputId, inputPassword) ) {
                System.out.println("Password approved.");
                loginAgent(inputId);
                break;
            }
            else {
                System.out.println("Incorrect password.");
                blacklistAgent(inputId);
            }
        }
        System.out.println("Press enter to exit program.");
        scanner.nextLine();
    }



    public static String askForId() {
        System.out.println();
        System.out.println("Please insert your ID.");
        String input = scanner.nextLine();
        System.out.println();
        return input;
    }

    /* JH: Probeer de business logica in OOP classes te vatten in plaats van static is... functies (Procudureel) te doen (Procudureel Object Oriented Programming = POOP, it smells)
    *      Maak ook bijvoorbeeld een ILoginValidation interface */


    public static boolean isNumber(String input) { /* JH: Zou deze functie niet is3DigitNumber moeten heten of anders de lengte check in eigen functie zetten */
        if( input == null || input.isEmpty() ) { // check if empty
            return false;
        }
        if( input.length() > (ID_DIGITS + 1/* JH: De + 1 is verwarrend, waarom staat deze hier, ID_DIGITS = 3, dus waarom test voor > 4 ?? */) ) { // check if string larger than 3 digits
            return false;
        }
        for( int i = 0; i < input.length(); i++ ) { // check if all input string characters are ints
            char c = input.charAt(i);

            if( c < '0' || c > '9' ) { /* JH TIP: er is ook een functie Character.isDigit(char ch) die precies dit doet */
                return false;
            }
        }
        return true;
    }

    public static boolean isCorrectId(int input) {
        return ( input >= MIN_AGENT_ID && input <= MAX_AGENT_ID );
    }

    public static boolean isBlacklisted(String input) {
        if( blacklist.contains(input) ) {
            System.out.println("ID " + input + " has been blacklisted."); /* JH: Dit is een business logic functie, deze mag geen presentatie logica bevatten */
            return true;
        }
        else return false;
    }

    public static String approveId(String input) {
        System.out.println("ID approved.");
        System.out.println("Your ID is " + input);
        return input;
    }

    public static String addPaddingZeroes(String input) { /* JH TIP: Kijk ooke eens naar string.Format() */
        String padded = input;
        for( int i = input.length(); i < ID_DIGITS; i++ ) {
            padded = "0" + padded;
        }
        return padded;
    }

    public static String askForPassword() {
        System.out.println();
        System.out.println("Please enter your password");
        String input = scanner.nextLine();
        System.out.println();
        return input;
    }

    public static boolean isCorrectPassword(String id, String password ) {
        return ( password.equals(SECRET_PASSWORD) );
    }

    public static void blacklistAgent(String agentId) {
        blacklist.add(agentId);
        System.out.println("ID " + agentId + " has been blacklisted.");
    }

    public static void loginAgent(String inputId) {
        System.out.println();
        System.out.println("Agent " + inputId + ", you have been successfully logged in.");
    }
}
