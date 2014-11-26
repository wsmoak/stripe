package net.wsmoak.stripe;

import junit.framework.Test;
import junit.framework.TestCase;
import junit.framework.TestSuite;
import com.stripe.*;
import com.stripe.model.*;
import java.util.*;

/**
 * Unit test for simple App.
 */
public class AppTest 
    extends TestCase
{
    /**
     * Create the test case
     *
     * @param testName name of the test case
     */
    public AppTest( String testName )
    {
        super( testName );
    }

    /**
     * @return the suite of tests being tested
     */
    public static Test suite()
    {
        return new TestSuite( AppTest.class );
    }

    /**
     * Rigourous Test :-)
     */
    public void testApp()
    {
      	//Stripe.apiKey = "sk_test_4ZzDUb994ZRgtOISmFn9Jq6u";
        Stripe.apiKey = System.getenv("STRIPE_SECRET_KEY");
		    System.out.println("The api key is " + Stripe.apiKey);
		    // Stripe.apiVersion = "2014-08-20"; // to test a specific version
		    // System.out.println("The api version is " + Stripe.apiVersion);
        assertTrue( true );
    }

    /**
     * #stripe irc 2014-11-26 helping Textiletribe
     */
    public void XXXtestSharedCustomer() throws Exception
    {
      Stripe.apiKey = System.getenv("STRIPE_SECRET_KEY");
      
      String customerId = System.getenv("STRIPE_CUSTOMER_ID");
      String accessToken = System.getenv("STRIPE_ACCESS_TOKEN"); // Connected Account ends in 49W
      
      Map<String, Object> tokenParams = new HashMap<String, Object>();
      tokenParams.put("customer", customerId);
      Token chargeToken = Token.create(tokenParams, accessToken);
                  
                  
      final Map<String, Object> chargeParams = new HashMap<String, Object>();
 
      chargeParams.put("amount", 65000);
      chargeParams.put("currency", "usd");
 
      // USER ID
      Map<String, String> metadata = new HashMap<String, String>();
      metadata.put("id", "ABCDEF");
      chargeParams.put("metadata", metadata);
 
      // CARD + FEE
      //chargeParams.put("card", chargeToken ); //original code passed the entire object
      chargeParams.put("card", chargeToken.getId());   //fixed
      chargeParams.put("application_fee", 2800);
 
      Charge charge = Charge.create(chargeParams, accessToken);
      
      assertTrue(true);
      
    }

}
