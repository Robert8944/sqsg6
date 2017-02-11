<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags"%>
<html>
<head>
<!--
<link rel="stylesheet" type="text/css" 
	href='<c:url value="resources/css/base.css"/>'>
-->
<link rel="stylesheet" type="text/css"
	href='<c:url value="resources/css/header.css"/>'>
<spring:url value="/resources/images/" var="images" />
</head>
<body>
	<div class="header-container column-container">
		<div id="logoContainer" class="logo-container">
			<img src="${images}logo.png" alt="SQS Logo" class="logo"/>
		</div>
		<c:choose>
			<c:when test="${user != null}">
				<div class="greeting-container">Welcome back, ${user.userId}</div>
			</c:when>
			<c:otherwise>
				<div class="greeting-container">Welcome To The SQS Training Website</div>
			</c:otherwise>
		</c:choose>
	</div>
</body>
</html>