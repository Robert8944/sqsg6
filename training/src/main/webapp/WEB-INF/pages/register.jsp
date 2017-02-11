<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<spring:url value="/resources/css/base.css" var="baseCss" />
	<spring:url value="/resources/css/register.css" var="registerCss" />

	<link rel="stylesheet" type="text/css" href="${baseCss}" />
	<link rel="stylesheet" type="text/css" href="${registerCss}" />

	<title>SQS Training - Subscribe</title>
</head>
<body>
	<div id="mainContainer" class="main-container">
		<%@include file='header.jsp'%>
		<%@include file='toolbar.jsp'%>
		<div id="contentContainer" class="content-container column-container">
			<form:form action="registerUser" method="post" commandName="registrationForm" class="register-user column-container">
				<div class="text-input-container">	<!-- This div undoes the scaling fix below (otherwise the text input field is too small. -->
					<form:input path="firstName" placeholder="Enter your first name." class="text-input column-container"/>
					<br>
					<form:input path="lastName" placeholder="Enter your last name." class="text-input column-container"/>
					<br>
					<form:input path="userId" placeholder="Enter your desired user ID." class="text-input column-container"/>
					<br>
					<form:input path="password" placeholder="Enter your password." class="text-input column-container"/>
				</div>
				<div>	<!-- This div just fixes a flexbox scaling issue where the submit button is HUGE -->
					<input type="submit" value="Register" class="raised-button column-container"/>
				</div>
			</form:form>
		</div>
	</div>
</body>
</html>