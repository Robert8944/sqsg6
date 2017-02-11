package com.sqs.training.controller;

import java.util.Map;

import javax.servlet.http.HttpSession;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.authentication.AuthenticationManager;
import org.springframework.security.authentication.BadCredentialsException;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.security.core.Authentication;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.RequestMapping;

import com.sqs.training.domain.User;

@Controller
public class AuthenticationController {
	
	@Autowired
	private AuthenticationManager authenticationManager;

	@RequestMapping("/login")
	public String displayLoginPage(Map<String, Object> model) {
		User loginForm = new User();
		model.put("loginForm",loginForm);
		return "login";
	}
	
	@RequestMapping("/loginUser")
	public String loginUser(@ModelAttribute("loginForm") User user, Map<String, Object> model,
			HttpSession session) {
		Authentication authentication = new UsernamePasswordAuthenticationToken(user.getUserId(), user.getPassword());
		try {
			Authentication checkAuth = authenticationManager.authenticate(authentication);
		} catch (BadCredentialsException e) {
			return "login";
		}
		session.setAttribute("user", user);
		return "home";
	}
	
	@RequestMapping("/logout")
	public String logoutUser(Map<String, Object> model,
			HttpSession session) {
		return "home";
	}
}
