<h1>Validate Ip-addresses with REST API</h1>

<h4>Validate an IP address</h4>
<p>To validate an IP-address send a POST request with <code>ipAddress: the-ip-address</code> in the form-data in the body.</p>
<p>Example:</p>
<code>POST <?=$url?></code> <br>
<p>body: <code>ipAddress: 127.0.0.1</code> <br></p>

<p>Result: </p>

<pre style="background-color: #eee; color: black;">
{
    "ip": "127.0.0.1",
    "validity": "Valid",
    "domain": "localhost"
}
</pre>


<br>
<form method="post">
    <input type="text" name="ipAddress">
    <input type="submit" name="submit" value="Validate">
</form>

