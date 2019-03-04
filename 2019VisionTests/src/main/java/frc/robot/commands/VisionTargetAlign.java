/*----------------------------------------------------------------------------*/
/* Copyright (c) 2018 FIRST. All Rights Reserved.                             */
/* Open Source Software - may be modified and shared by FRC teams. The code   */
/* must be accompanied by the FIRST BSD license file in the root directory of */
/* the project.                                                               */
/*----------------------------------------------------------------------------*/

package frc.robot.commands;

import edu.wpi.first.wpilibj.command.Command;
import frc.robot.Robot;

public class VisionTargetAlign extends Command {
  private static double targetDistance = 5, directionDistanceConstant = 0.2, endPointHeight = 1, endPointDX = 0.1;
  private static double[] xi, yi;
  public VisionTargetAlign() {
    xi = new double[4];
    yi = new double[4];
    // Use requires() here to declare subsystem dependencies
    // eg. requires(chassis);
    requires(Robot.m_driveTrain);
    requires(Robot.m_jetson);
  }

  // Called just before this Command runs the first time
  @Override
  protected void initialize() {
  }

  // Called repeatedly when this Command is scheduled to run
  @Override
  protected void execute() {
    double[] powers = new double[2];
    double[] rawValues = Robot.m_jetson.getRawValues();
    double angle = rawValues[0];
    double x = rawValues[1];
    double y = rawValues[2];
    xi[0] = x;
    xi[1] = xi[0]-Math.cos(angle)*directionDistanceConstant;
    xi[3] = 0;
    xi[2] = endPointDX;
    yi[0] = y;
    yi[1] = yi[0]-Math.sin(angle)*directionDistanceConstant;
    yi[3] = targetDistance;
    yi[2] = yi[3]+endPointHeight;
    double targetPower = 0.2;
    powers[0] = targetPower;
    powers[1] = targetPower*turnRatio(x-1);
    System.out.println(powers[0] + " " + powers[1]);
    Robot.m_driveTrain.tankDrive(powers[0], powers[1]);
  }

  protected double derivative(double x){
    double derivativeApproxDelta = 0.1;
    return (pathFunction(x+derivativeApproxDelta)-pathFunction(x))/derivativeApproxDelta;
  }

  protected double curveRadius(double x){
    double c = 0.1;
    double m1 = -1/(derivative(x-c));
    double m2 = -1/(derivative(x+c));
    double xi = (pathFunction(x-c) - pathFunction(x+c) +m2*(x+c) -m1*(x-c))/(m2-m1);
    double yi = m2*(xi-(x+c))+pathFunction(x+c);
    double r = Math.sqrt(Math.pow(x-xi, 2)+Math.pow(pathFunction(x)-yi, 2));
    if (xi-x > 0){
      return r;
    } else {
      return -r;
    }
  }

  protected double turnRatio(double x){
    double w = 30;
    double r = curveRadius(x);
    return (2*r+w)/(2*r-w);
  }

  protected double pathFunction(double x){
    double y = 0;
    for (int i = 0; i < xi.length; i++){
      double term = 1;
      for (int j = 0; j < xi.length; j++){
        if (i != j){
          term *= (x-xi[j])/(xi[i]-xi[j]);
        }
      }
      y += yi[i]*term;
    }
    return y;
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
