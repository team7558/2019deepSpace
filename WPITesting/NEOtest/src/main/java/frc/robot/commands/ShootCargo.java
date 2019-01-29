/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import frc.robot.Robot;
import com.ctre.phoenix.motorcontrol.ControlMode;

public class ShootCargo extends Command {

  public int num = 0;

  public ShootCargo() {
    super();
    requires(Robot.m_Cargo);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {

  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
<<<<<<< HEAD
    num++;
    System.out.println("Execute " + num);
    

=======
    Robot.m_Cargo.shoot();
>>>>>>> 9c6d0775656e1783419290d780b49b623c90288c
  }

  // Make this return true when this Command no longer needs to run execute()
  // Not required when using whileHeld
  @Override
  protected boolean isFinished() {
    return isTimedOut();
  }

  // Called once after isFinished returns true
  @Override
  protected void end() {
    Robot.m_Cargo.stopShoot();

  }

  // Called when another command which requires one or more of the same
  // subsystems is scheduled to run
  @Override
  protected void interrupted() {

  }
}
