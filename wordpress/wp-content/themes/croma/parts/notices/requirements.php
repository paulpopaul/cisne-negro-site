<div class="notice notice-error">
	<div class="message">
        <h2>Requirements & Recommendations</h2>
        <p>Please contact your hosting provider to increase the "Memory limit" of you server.</p>
    </div>
    <table class="table table-hover ">
    <thead>
        <tr>
            <th>Settings</th>
            <th>Currents</th>
            <th>Required</th>
            <th>Recommanded</th>
            <th>Documentation</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Memory Limit</td>
            <td><?php echo esc_html( ini_get('memory_limit') ) ?></td>
            <td>32M</td>
            <td>64M</td>
            <td><a target="_blank" href="http://php.net/manual/en/ini.core.php">PHP Documentation "php.ini file"</a></td>
        </tr>
    </tbody>
    </table>
</div>