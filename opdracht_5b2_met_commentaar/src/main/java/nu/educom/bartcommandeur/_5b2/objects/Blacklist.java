package nu.educom.bartcommandeur._5b2.objects; /* JH: Dit worden domainObjects genoemd */

import java.util.List;
import java.util.ArrayList;

public class Blacklist {
    List<String> blacklist;

    public Blacklist() {
        blacklist = new ArrayList<String>();
    }

    public void add(String agentId) {
        blacklist.add(agentId);
    }

    public boolean isBlacklisted(String input) {
        if( blacklist.contains(input) ) {
            return true;
        }
        else return false;
    }
}
