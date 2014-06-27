package com.seventh.SeventhShare.activity;

import org.json.JSONException;
import org.json.JSONObject;

import com.seventh.SeventhShare.HandlerCode;
import com.seventh.SeventhShare.R;
import com.seventh.SeventhShare.httpclient.UserFunctions;
import com.seventh.SeventhShare.util.CheckNetworkStateUtil;

import android.app.Activity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.text.TextUtils;
import android.view.WindowManager;
import android.widget.Toast;
public class ScreenSplash extends Activity {
	
	private String customername;
	private String customerpass;
	private String customerid;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		getActionBar().hide();
		getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN,
				WindowManager.LayoutParams.FLAG_FULLSCREEN);
		setContentView(R.layout.activity_screensplash);
		/** set time to splash out **/
		handler_login.sendEmptyMessage(HandlerCode.LOGIN_CUSTOMER_BEGIN);
		final int nWelcomeScreenDisplay = 3000;
		new Handler().postDelayed(new Runnable() {
			@Override
			public void run() {
				Intent mainIntent = new Intent(ScreenSplash.this, MainActivity.class);
				Bundle bundle=new Bundle();
				bundle.putString("customerid", customerid);
				mainIntent.putExtras(bundle);
				startActivity(mainIntent);
				ScreenSplash.this.finish();
			}
		}, nWelcomeScreenDisplay);
	}
	/**
	 * Login Function
	 * 
	 * @return login result
	 */
	private String loginStart() {
		String loginresult = "";
		SharedPreferences sp = getSharedPreferences("config", MODE_PRIVATE);
		customername = sp.getString("Customer_name", "");
		customerpass = sp.getString("Customer_pass", "");
		if (TextUtils.isEmpty(customername) || TextUtils.isEmpty(customerpass)) {
			
		} else if (!CheckNetworkStateUtil.checkNet(getApplicationContext())) {
			Toast.makeText(getApplicationContext(), "请检查网络连接", Toast.LENGTH_SHORT).show();
		} else {
			new Thread(loginThread).start();
		}
		return loginresult;
	}

	/**
	 * Login Thread
	 */
	private Runnable loginThread = new Runnable() {
		public void run() {
			UserFunctions userFunction = new UserFunctions();
			JSONObject json = userFunction.loginUser(customername, customerpass);
			try {
				customerid=json.getJSONObject("customer").getString("id");
			} catch (JSONException e) {
				e.printStackTrace();
			}
		}
	};
	Handler handler_login = new Handler() {
		@Override
		public void handleMessage(Message msg) {
			int whatVal = msg.what;
			switch (whatVal) {
			case HandlerCode.LOGIN_CUSTOMER_BEGIN:
				loginStart();
				break;
			}
		}
	};
}