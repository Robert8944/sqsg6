package com.sqs.training.controller;

import java.util.Map;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestMapping;

@Controller
public class DefaultController {

	@RequestMapping(value = {"/home", "/"})
	public String displayHomePage(Map<String, Object> model) {
		return "home";
	}
}
