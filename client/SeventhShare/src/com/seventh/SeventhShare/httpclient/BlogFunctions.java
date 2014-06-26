package com.seventh.SeventhShare.httpclient;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

public class BlogFunctions {
	
	private JSONParser jsonParser;
	
	/*private static String loginURL = "http://1.intelligentguide.sinaapp.com/index.php";
	private static String registerURL = "http://1.intelligentguide.sinaapp.com/index.php";*/
	
	private static String blogURL = "http://192.168.0.69:4267/test/index.php";
	
	private static String blog_publish_tag = "publish";
	
	// constructor
	public BlogFunctions(){
		jsonParser = new JSONParser();
	}
	
	
	public JSONObject publishBlog(String customerid, String title, String content){
		// Building Parameters
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("tag", blog_publish_tag));
		params.add(new BasicNameValuePair("customerid", customerid));
		params.add(new BasicNameValuePair("title", title));
		params.add(new BasicNameValuePair("content", content));
		
		// getting JSON Object
		JSONObject json = jsonParser.getJSONFromUrl(blogURL, params);
		return json;
	}
}
