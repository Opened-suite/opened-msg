<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenedSuite EULA</title>
</head>
<body>
    <div style="max-width: 600px; margin: 0 auto;">
        <h1>End User License Agreement (EULA) for OpenedSuite</h1>
        <p>Welcome to OpenedSuite, an open-source software suite developed by Heberking. Before using this software, please carefully read and accept the terms of this End User License Agreement (EULA). Your use of this software implies your acceptance of these terms.</p>
        <p>1. Definitions</p>
        <p>1.1. "Software" refers to the OpenedSuite software suite developed by Heberking, including any source code, documentation, and other associated resources.</p>
        <p>1.2. "User" refers to any individual or entity who uses the Software.</p>
        
        <p>2. License</p>
        <p>2.1. License Grant: Heberking grants the User a non-exclusive, worldwide, royalty-free, and non-transferable license to use, reproduce, modify, and distribute the Software, subject to the terms set forth in this EULA.</p>
        <p>2.2. Restrictions: The User agrees not to remove or modify any copyright notices, trademarks, or other proprietary notices included in the Software. The User also agrees to comply with all applicable laws and regulations when using the Software.</p>

        <p>3. Responsibilities</p>
        <p>3.1. Warranty Disclaimer: The Software is provided "as is," without warranty of any kind, express or implied, including but not limited to the warranties of merchantability, fitness for a particular purpose, and non-infringement.</p>
        <p>3.2. Limitation of Liability: In no event shall Heberking be liable for any direct, indirect, incidental, special, exemplary, or consequential damages arising out of the use or inability to use the Software, even if Heberking has been advised of the possibility of such damages.</p>

        <p>4. Acceptance of EULA</p>
        <p>By clicking the "Accept" button below, you confirm that you have read, understood, and agreed to the terms of this End User License Agreement. If you do not agree to these terms, please do not use the Software.</p>
        
        <form action="return_eula.php" method="post">
            <input type="hidden" name="accepted" value="true">
            <button class="button-86" role="button">Accept EULA</button>


        </form>

        <p>5. Entry into Force</p>
        <p>This EULA enters into force when the User clicks the "Accept" button above.</p>
        <p>By clicking the "Accept" button, you also consent to a file named "accepted.txt" being created in the Software's directory with the content "true" indicating your acceptance of the terms of this EULA.</p>
    </div>
</body>
<style>
    /* CSS */
.button-86 {
  all: unset;
  width: 100px;
  height: 30px;
  font-size: 16px;
  background: transparent;
  border: none;
  position: relative;
  color: #f0f0f0;
  cursor: pointer;
  z-index: 1;
  padding: 10px 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  white-space: nowrap;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
}

.button-86::after,
.button-86::before {
  content: '';
  position: absolute;
  bottom: 0;
  right: 0;
  z-index: -99999;
  transition: all .4s;
}

.button-86::before {
  transform: translate(0%, 0%);
  width: 100%;
  height: 100%;
  background: #28282d;
  border-radius: 10px;
}

.button-86::after {
  transform: translate(10px, 10px);
  width: 35px;
  height: 35px;
  background: #ffffff15;
  backdrop-filter: blur(5px);
  -webkit-backdrop-filter: blur(5px);
  border-radius: 50px;
}

.button-86:hover::before {
  transform: translate(5%, 20%);
  width: 110%;
  height: 110%;
}

.button-86:hover::after {
  border-radius: 10px;
  transform: translate(0, 0);
  width: 100%;
  height: 100%;
}

.button-86:active::after {
  transition: 0s;
  transform: translate(0, 5%);
}
</style>
</html>
