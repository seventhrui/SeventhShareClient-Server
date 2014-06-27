package com.seventh.SeventhShare.fragment;

import org.json.JSONException;
import org.json.JSONObject;

import com.seventh.SeventhShare.HandlerCode;
import com.seventh.SeventhShare.R;
import com.seventh.SeventhShare.activity.MainActivity;
import com.seventh.SeventhShare.bean.CustomerInfoBean;
import com.seventh.SeventhShare.dao.DatabaseHandler;
import com.seventh.SeventhShare.httpclient.UserFunctions;
import com.seventh.SeventhShare.util.CheckNetworkStateUtil;

import android.app.Fragment;
import android.app.FragmentManager;
import android.content.Context;
import android.content.SharedPreferences.Editor;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

/**
 * Fragment -- Register
 * 
 */
public class Fragment_Register extends Fragment {
	private Context context;
	private View rootView = null;
	
	private EditText et_register_name;//username
	private EditText et_register_pass;//user password
	private EditText et_register_passconfirm;//user password confirm
	private EditText et_register_email;//user email
	private EditText et_register_phone;//user phone
	private EditText et_register_qq;//user qq
	private TextView tv_register_error;
	
	private Button btn_register_submit;
	private Button btn_register_login;

	private String customername = "";
	private String customerpass = "";
	private String passconfirm = "";
	private String customeremail = "";
	private String customerphone = "";
	private String customerqq = "";
	private Thread threadregister = null;

	private UserFunctions userFunction=null;
	private CustomerInfoBean customer=null;
	
	// JSON Response node names
	private JSONObject json = null;
	private static String KEY_SUCCESS = "success";
	private static String KEY_ERROR = "error";
	private static String KEY_ERROR_MSG = "error_msg";
	private static String KEY_UID = "id";
	private static String KEY_NAME = "name";
	private static String KEY_EMAIL = "email";
	private static String KEY_PHONE = "phone";
	private static String KEY_QQ = "qq";
	private static String KEY_UPTIME = "uptime";

	public Fragment_Register(Context c) {
		this.context = c;
	}

	@Override
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {

		initView(inflater, container);
		initListener();
		return rootView;
	}

	/**
	 * Initialize the View
	 * 
	 * @param i
	 * @param c
	 */
	private void initView(LayoutInflater i, ViewGroup c) {
		rootView = i.inflate(R.layout.fragment_register_page, c, false);
		
		et_register_name = (EditText) rootView.findViewById(R.id.et_register_name); 
		et_register_pass = (EditText) rootView.findViewById(R.id.et_register_pass);
		et_register_passconfirm = (EditText) rootView.findViewById(R.id.et_register_passconfirm);
		et_register_email = (EditText) rootView.findViewById(R.id.et_register_email);
		et_register_phone = (EditText) rootView.findViewById(R.id.et_register_phone);
		et_register_qq = (EditText) rootView.findViewById(R.id.et_register_qq);
		tv_register_error = (TextView) rootView.findViewById(R.id.tv_register_error);
		
		btn_register_submit = (Button) rootView.findViewById(R.id.btn_register_submit);
		btn_register_login = (Button) rootView.findViewById(R.id.btn_register_login);
	}

	/**
	 * Initialize the Listener
	 */
	private void initListener() {
		RegisterOnclickListener roll = new RegisterOnclickListener();
		btn_register_submit.setOnClickListener(roll);
		btn_register_login.setOnClickListener(roll);
	}

	/**
	 * OnclickListener
	 * 
	 */
	class RegisterOnclickListener implements OnClickListener {
		@Override
		public void onClick(View v) {
			switch (v.getId()) {
			case R.id.btn_register_submit:
				handler_login.sendEmptyMessage(HandlerCode.LOGIN_CUSTOMER_BEGIN);
				break;
			case R.id.btn_register_login:
				break;
			}
		}
	}
	
	/**
	 * Register Function
	 * @return login result
	 */
	private String registerStart() {
		String loginresult = "";
		
		customername = et_register_name.getText().toString().trim();
		customerpass = et_register_pass.getText().toString().trim();
		passconfirm = et_register_passconfirm.getText().toString().trim();
		customeremail = et_register_email.getText().toString().trim();
		customerphone = et_register_phone.getText().toString().trim();
		customerqq = et_register_qq.getText().toString().trim();
		
		if (TextUtils.isEmpty(customername) || TextUtils.isEmpty(customerpass)) {
			Toast.makeText(getActivity(), "帐码或密码不能为空", Toast.LENGTH_SHORT).show();
		} else if(!customerpass.equals(passconfirm)){
			Toast.makeText(context, "两次密码不一致", Toast.LENGTH_SHORT).show();
		} else if(TextUtils.isEmpty(customeremail) && TextUtils.isEmpty(customerphone) && TextUtils.isEmpty(customerqq)){
			Toast.makeText(context, "邮箱/电话/QQ不能全为空", Toast.LENGTH_SHORT).show();
		} else if(!CheckNetworkStateUtil.checkNet(context)){
			Toast.makeText(context, "请检查网络连接", Toast.LENGTH_SHORT).show();
		} else{
			threadregister=new Thread(registerThread);
			threadregister.start();
		}
		return loginresult;
	}
	/**
	 * Login Thread
	 */
	private Runnable registerThread = new Runnable() {
		public void run() {
			userFunction = new UserFunctions();
			json = userFunction.registerUser(customername, customerpass, customeremail, customerphone, customerqq);
			// Check Login
			try {
				if (json.getString(KEY_SUCCESS) != null) {
					String res = json.getString(KEY_SUCCESS);
					if (Integer.parseInt(res) == 1) {
						handler_login.sendEmptyMessage(HandlerCode.LOGIN_CUSTOMER_SUCCESS);
					} else {
						handler_login.sendEmptyMessage(HandlerCode.LOGIN_CUSTOMER_FAILURE);
					}
				}
			} catch (JSONException e) {
				e.printStackTrace();
			}
		}
	};

	/**
	 * Login Error
	 */
	private void registerError() {
		tv_register_error.setText("注册失败");
	}
	/**
	 * Goto  Fragment_lv
	 */
	private void gotoPage() {
		Fragment fragment=new Fragment_Login(context);
		FragmentManager fragmentManager = getFragmentManager();
		Bundle bundle=new Bundle();
		bundle.putString("customername", customername);
		fragment.setArguments(bundle);
		fragmentManager.beginTransaction().replace(R.id.content_frame, fragment).commit();
		String planet = "登录";
		getActivity().setTitle(planet);
	}
	private Handler handler_login = new Handler() {
		@Override
		public void handleMessage(Message msg) {
			int whatVal = msg.what;
			switch (whatVal) {
			case HandlerCode.LOGIN_CUSTOMER_BEGIN:
				registerStart();
				break;
			case HandlerCode.LOGIN_CUSTOMER_SUCCESS:
				Toast.makeText(context, "注册成功", Toast.LENGTH_SHORT).show();
				gotoPage();
				break;
			case HandlerCode.LOGIN_CUSTOMER_FAILURE:
				registerError();
				break;
			}
		}
	};
}
