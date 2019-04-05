/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import frc.robot.Robot;

public class JoyDrive extends Command {
  private double driveMax;
  private double turnMax;

  public JoyDrive() {
    super();
    // Use requires() here to declare subsystem dependencies
    requires(Robot.m_driveTrain);
    setMaxSpeeds(0.75, 0.6);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {
    
  }

  public void setMaxSpeeds(double straightSpeed, double turnSpeed){
    driveMax = straightSpeed;
    turnMax = turnSpeed;
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    // speed, turn
    double speed = Robot.m_oi.m_driver.getRawAxis(Robot.m_oi.throttle);
    double turnValue = -Robot.m_oi.m_driver.getRawAxis(Robot.m_oi.turnStick);
    //System.out.println(turnValue);
    /*
    if (Math.abs(turnValue) < 0.01){
      turnValue = 0;
    }
    */
    Robot.m_driveTrain.drive(speed*driveMax, turnValue*turnMax);
  }

  // Make this return true when this Command no longer needs to run execute()
  @Override
  protected boolean isFinished() {
    return false;
  }

  // Called once after isFinished returns true
  @Override
  protected void end() {
  }

  // Called when another command which requires one or more of the same
  // subsystems is scheduled to run
  @Override
  protected void interrupted() {
  }

}
