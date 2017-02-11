<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags"%>
<html>
<head>
	<spring:url value="/resources/css/base.css" var="baseCss" />
	<spring:url value="/resources/css/login.css" var="loginCss" />

	<link rel="stylesheet" type="text/css" href="${baseCss}" />
	<link rel="stylesheet" type="text/css" href="${loginCss}" />

	<title>SQS Training - Login</title>
</head>
<body>
	<div id="mainContainer" class="main-container">
		<%@include file='header.jsp'%>
		<%@include file='toolbar.jsp'%>
		<div id="contentContainer" class="content-container column-container">
			<form:form action="loginUser" method="post" commandName="loginForm" class="login-user column-container">
				<div class="login-error">
					${errorMessage}
				</div>
				<div class="text-input-container">	<!-- This div undoes the scaling fix below (otherwise the text input field is too small. -->
					<form:input path="userId" placeholder="Enter your user ID." class="text-input column-container"/>
					<br>
					<form:input path="password" placeholder="Enter your password." class="text-input column-container"/>
				</div>
				<div>	<!-- This div just fixes a flexbox scaling issue where the submit button is HUGE -->
					<input type="submit" value="Login" class="raised-button column-container"/>
				</div>
			</form:form>
		</div>
	</div>
</body>
</html>