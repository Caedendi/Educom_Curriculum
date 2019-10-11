package nu.educom.bartcommandeur._5b2.models;

import java.util.ArrayList;
import java.util.List;

public class MISixModel implements ILoginValidation {
    final int MIN_AGENT_ID = 1;
    final int MAX_AGENT_ID = 956;
    final int MIN_ID_DIGITS = Integer.toString(MIN_AGENT_ID).length(); /* JH: Deze wordt nooit gebruikt */
    final int MAX_ID_DIGITS = Integer.toString(MAX_AGENT_ID).length();
    final /* JH: private */ String SECRET_PASSWORD = "For ThE Royal QUEEN";

    private List<String> blacklist;
    private String id;
    private String password;
    private boolean idValid = false;
    private boolean isLoggedIn = false;

    public MISixModel() {
        blacklist = new ArrayList<String>(); /* JH: Object 'Blacklist' wordt hier niet gebruikt */
    }

    @Override
    public boolean isNumericId() {
        for (int i = 0; i < id.length(); i++) { // check if all characters in input string are numbers
            if (!Character.isDigit(id.charAt(i)))
                return false;
        }
        return true;
    }

    @Override
    public void checkLeftPaddingZeroes() {
        // add zeroes if smaller than specified digits
        if( id.length() < MAX_ID_DIGITS ) {
            for (int i = id.length(); i < MAX_ID_DIGITS; i++) {
                id = "0" + id; } /* JH: Zet voor de leesbaarheid het } op de volgende regel */
        }
        // else remove padded zeroes if larger than specified digits
        else if( id.length() > MAX_ID_DIGITS ) {
            for (int i = id.length(); i > MAX_ID_DIGITS; i--) {
                if( id.charAt(0) == '0' ) {
                    id = id.substring(1); } // removes a left padded 0  /* JH: Zet voor de leesbaarheid het } op de volgende regel */
                else return; /* JH: Laat een else altijd volgen door een { */
            }
        }
    }

    @Override
    public boolean verifyId() {
        if( id.length() > MAX_ID_DIGITS ) {
            return false; }
        try {
            int idCopy = Integer.parseInt(id);
            return (idCopy >= MIN_AGENT_ID && idCopy <= MAX_AGENT_ID);
        }
        catch(NumberFormatException e) { // in case input string ID is larger than int max value
            /* JH: Deze exceptie zou alleen theoretisch kunnen, omdat je strings met lengte > 3 niet toestaat in regel 52 */
            return false;
        }
    }

    @Override
    public boolean verifyPassword() {
        if( id.equals(null) || id.isBlank() || !idValid ) {
            // throw error: id invalid
            return false;
        }
        return ( password.equals(SECRET_PASSWORD) );
    }

    @Override
    public void blacklistAgent() {
        blacklist.add(id);
    }

    @Override
    public boolean isBlacklisted() {
        return blacklist.contains(id);
    }

    @Override
    public void loginAgent() {
        isLoggedIn = true;
    }

    @Override
    public void reset() { /* Deze functie wordt nergens aangeroepen */
        blacklist = new ArrayList<String>();
        id = null;
        password = null;
        idValid = false;
        isLoggedIn = false;
    }

    //=======================================//
    //========== Getters & Setters ==========//
    //=======================================//
    @Override
    public String getId() {
        return id;
    }

    @Override
    public void setId(String id) {
        this.id = id;
    }

    @Override
    public void setPassword(String password) {
        this.password = password;
    }

    @Override
    public boolean getIdValid() {
        return idValid;
    }

    @Override
    public void setIdValid(boolean idValid) {
        this.idValid = idValid;
    }

    @Override
    public boolean isLoggedIn() {
        return isLoggedIn;
    }
}